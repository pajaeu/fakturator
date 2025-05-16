<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

trait ResetsValidationAfterUpdate
{
    public function updated(string $property): void
    {
        $this->validateOnly($property);

        $this->resetErrorBag($property);
    }
}
