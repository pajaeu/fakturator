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

    public bool $selectAllContacts = false;

    /** @var array<mixed> */
    public array $selectedContacts = [];

    public function updatedSelectAllContacts(): void
    {
        $this->selectedContacts = $this->selectAllContacts ? Contact::query()->pluck('id')->toArray() : [];
    }

    public function updatedSelectedContacts(): void
    {
        $this->selectAllContacts = false;
    }

    public function delete(int $id): void
    {
        $contact = Contact::query()->find($id);

        if (! $contact) {
            return;
        }

        $this->authorize('delete', $contact);

        $contact->delete();
    }

    public function bulkDelete(): void
    {
        Contact::query()->whereIn('id', $this->selectedContacts)->each(function ($contact): void {
            $this->authorize('delete', $contact);

            $contact->delete();
        });

        $this->selectAllContacts = false;
        $this->selectedContacts = [];
    }

    public function render(): View
    {
        return view('livewire.contacts.index', [
            'contacts' => Contact::query()->orderBy('name')->paginate(12),
        ]);
    }
}
