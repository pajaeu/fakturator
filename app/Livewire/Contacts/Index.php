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

    public function delete(int $id): void
    {
        $contact = Contact::query()->find($id);

        if (! $contact) {
            return;
        }

        $this->authorize('delete', $contact);

        $contact->delete();
    }

    public function render(): View
    {
        return view('livewire.contacts.index', [
            'contacts' => Contact::query()->orderBy('name')->paginate(12),
        ]);
    }
}
