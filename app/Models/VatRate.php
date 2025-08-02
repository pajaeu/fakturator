<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\CurrentUserScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property string $name
 * @property float $rate
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id
 * @property-read User $user
 */
#[ScopedBy(CurrentUserScope::class)]
final class VatRate extends Model
{
    protected $casts = [
        'rate' => 'float',
    ];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
