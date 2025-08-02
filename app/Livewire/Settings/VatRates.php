<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Models\VatRate;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class VatRates extends Component
{
    public string $name = '';

    public string|float $rate = '';

    #[On('open-rate-create-modal')]
    #[On('close-rate-create-modal')]
    public function resetCreateModal(): void
    {
        $this->reset('name', 'rate');

        $this->resetErrorBag(['name', 'rate']);
    }

    public function add(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        VatRate::query()->create([
            ...$data,
            'user_id' => auth()->id(),
        ]);

        $this->dispatch('close-rate-create-modal');
    }

    public function delete(int $id): void
    {
        $rate = VatRate::query()->find($id);

        if (! $rate) {
            return;
        }

        $rate->delete();
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'rate' => 'required|numeric|min:0.01',
        ];
    }

    public function render(): View
    {
        return view('livewire.settings.vat-rates', [
            'rates' => VatRate::all(),
        ]);
    }
}
