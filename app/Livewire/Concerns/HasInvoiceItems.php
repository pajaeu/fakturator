<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use Livewire\Attributes\Locked;

trait HasInvoiceItems
{
    /**
     * @var array<int, array{
     *     id: ?int,
     *     description: string,
     *     quantity: string|int,
     *     unit: string,
     *     unit_price: string|float,
     *     vat_rate: string|int,
     *     total: float,
     *     total_with_vat: float,
     * }>
     */
    public array $items = [];

    #[Locked]
    public float $total;

    #[Locked]
    public float $total_with_vat;

    public function updatedItems(): void
    {
        $this->recalculateTotals();

        $this->validateItems();

        $this->resetErrorBag('items.*');
    }

    public function addItem(): void
    {
        $this->items[] = [
            'id' => null,
            'description' => '',
            'quantity' => 1,
            'unit' => '',
            'unit_price' => 0,
            'vat_rate' => 0,
            'total' => 0,
            'total_with_vat' => 0,
        ];

        $this->recalculateTotals();
    }

    public function removeItem(int $index): void
    {
        unset($this->items[$index]);

        $this->items = array_values($this->items);

        $this->recalculateTotals();

        $this->resetValidation('items.*');
    }

    /**
     * @param  array<int, int>  $orders
     */
    public function updateItemOrder(array $orders): void
    {
        $reorderedItems = [];

        foreach ($orders as $position => $index) {
            if (! isset($this->items[$index])) {
                continue;
            }

            $reorderedItems[$position] = $this->items[$index];
        }

        ksort($reorderedItems);

        $this->items = array_values($reorderedItems);

        $this->resetValidation('items.*');
    }

    private function recalculateTotals(): void
    {
        $vatTotals = [];

        $items = collect($this->items)->map(function (array $item) use (&$vatTotals): array {
            $quantity = (int) $item['quantity'];
            $unitPrice = (float) $item['unit_price'];
            $vatRate = (int) $item['vat_rate'];

            $item['total'] = $quantity * $unitPrice;
            $item['total_with_vat'] = $item['total'] + ($item['total'] * $vatRate / 100);

            if (! isset($vatTotals[$vatRate])) {
                $vatTotals[$vatRate] = 0;
            }

            $vatTotals[$vatRate] += $item['total'] * $vatRate / 100;

            return $item;
        });

        $total = $items->sum('total');
        $totalWithVat = $items->sum('total_with_vat');

        $this->items = $items->all();
        $this->total = is_numeric($total) ? (float) $total : 0.0;
        $this->total_with_vat = is_numeric($totalWithVat) ? (float) $totalWithVat : 0.0;
    }

    private function validateItems(): void
    {
        $this->validate([
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer',
            'items.*.unit_price' => 'required|numeric',
        ]);
    }
}
