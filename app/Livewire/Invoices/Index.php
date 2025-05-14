<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use Illuminate\View\View;
use Livewire\Component;

final class Index extends Component
{
    public function render(): View
    {
        return view('livewire.invoices.index');
    }
}
