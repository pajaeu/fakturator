<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property string|null $company_id
 * @property string|null $vat_id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $zip
 * @property string|null $phone
 * @property string|null $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id
 * @property-read User $user
 */
final class Contact extends Model
{
    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
