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
 * @property string $number
 * @property string|null $variable_symbol
 * @property Carbon $issued_at
 * @property Carbon $due_at
 * @property float $total
 * @property string $supplier_company
 * @property string $supplier_company_id
 * @property string|null $supplier_vat_id
 * @property string $supplier_address
 * @property string $supplier_city
 * @property string $supplier_country
 * @property string $supplier_zip
 * @property string $customer_company
 * @property string|null $customer_company_id
 * @property string $customer_vat_id
 * @property string $customer_address
 * @property string $customer_city
 * @property string $customer_country
 * @property string $customer_zip
 * @property string|null $customer_phone
 * @property string|null $customer_email
 * @property string|null $note
 * @property array<int, mixed>|null $items
 * @property int|null $contact_id
 * @property-read Contact $contact
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id
 * @property-read User $user
 */
#[ScopedBy(CurrentUserScope::class)]
final class Invoice extends Model
{
    protected $casts = [
        'issued_at' => 'date',
        'due_at' => 'date',
        'total' => 'float',
        'items' => 'array',
    ];

    /** @return BelongsTo<Contact, $this> */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
