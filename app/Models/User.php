<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Country;
use App\Enums\UserTier;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read int $id
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string|null $company_id
 * @property string|null $vat_id
 * @property string|null $billing_company
 * @property string|null $billing_address
 * @property string|null $billing_city
 * @property Country|null $billing_country
 * @property string|null $billing_zip
 * @property UserTier $tier
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property-read Collection<int, Contact> $contacts
 * @property-read Collection<int, Invoice> $invoices
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function avatarUrl(): string
    {
        return sprintf('https://api.dicebear.com/9.x/thumbs/svg?seed=%s', $this->email);
    }

    /** @return HasMany<Contact, $this> */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /** @return HasMany<Invoice, $this> */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'billing_country' => Country::class,
            'tier' => UserTier::class,
        ];
    }
}
