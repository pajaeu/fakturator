<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\CurrentUserScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $name
 * @property string|null $icon
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, Invoice> $invoices
 * @property int $user_id
 * @property-read User $user
 */
#[ScopedBy(CurrentUserScope::class)]
final class Folder extends Model
{
    /** @return HasMany<Invoice, $this> */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
