<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Country;
use App\Enums\Currency;
use App\Enums\PaymentMethod;
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
 * @property float $total_with_vat
 * @property Currency $currency
 * @property string $supplier_company
 * @property string $supplier_company_id
 * @property string|null $supplier_vat_id
 * @property string $supplier_address
 * @property string $supplier_city
 * @property Country $supplier_country
 * @property string $supplier_zip
 * @property string $customer_company
 * @property string|null $customer_company_id
 * @property string $customer_vat_id
 * @property string $customer_address
 * @property string $customer_city
 * @property Country $customer_country
 * @property string $customer_zip
 * @property string|null $customer_phone
 * @property string|null $customer_email
 * @property string|null $note
 * @property array<int, mixed>|null $items
 * @property bool $is_paid
 * @property Carbon|null $paid_at
 * @property int|null $contact_id
 * @property-read Contact $contact
 * @property PaymentMethod $payment_method
 * @property int|null $bank_account_id
 * @property-read BankAccount|null $bankAccount
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
        'currency' => Currency::class,
        'is_paid' => 'boolean',
        'paid_at' => 'date',
        'payment_method' => PaymentMethod::class,
        'supplier_country' => Country::class,
        'customer_country' => Country::class,
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

    /** @return BelongsTo<BankAccount, $this> */
    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function isOverdue(): bool
    {

        return $this->due_at->isPast() && ! $this->is_paid;
    }
}
