<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Override;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[Override]
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureModels();
        $this->configureDates();
        $this->configureFortify();
        $this->configureNotifications();
    }

    private function configureModels(): void
    {
        Model::unguard();

        Model::automaticallyEagerLoadRelationships();
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configureFortify(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            /** @var string $username */
            $username = $request->input(Fortify::username());

            $throttleKey = Str::transliterate(Str::lower($username).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        Fortify::loginView('auth.login');
        Fortify::registerView('auth.register');
        Fortify::verifyEmailView('auth.verify');
    }

    private function configureNotifications(): void
    {
        VerifyEmail::toMailUsing(fn (User $user, string $url) => (new MailMessage)
            ->subject(__('Verify your account on Fakturátor'))
            ->view('mail.verify', [
                'user' => $user,
                'url' => $url,
            ]));
    }
}
