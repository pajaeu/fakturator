<?php

namespace App\Livewire\Invoices;

use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.invoices.index');
    }
}
