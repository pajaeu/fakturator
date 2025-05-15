<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

final class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        return view('livewire.contacts.index', [
            'contacts' => Contact::query()->orderBy('name')->paginate(12),
        ]);
    }
}
