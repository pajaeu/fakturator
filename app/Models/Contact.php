<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Country;
use App\Models\Scopes\CurrentUserScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property string $company_id
 * @property string|null $vat_id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property Country $country
 * @property string $zip
 * @property string|null $phone
 * @property string|null $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id
 * @property-read User $user
 */
#[ScopedBy(CurrentUserScope::class)]
final class Contact extends Model
{
    protected $casts = [
        'country' => Country::class,
    ];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
