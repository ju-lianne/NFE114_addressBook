<?php

namespace App\Livewire;

use App\Models\Contacts;
use Livewire\Component;
use Livewire\WithPagination;

class ContactsList extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Contacts::with(['personne.entreprise', 'categorie']);

        if (!empty($this->search)) {
            $searchTerm = '%' . $this->search . '%';
            $query->whereHas('personne', function($q) use ($searchTerm) {
                $q->where('nom', 'like', $searchTerm)
                    ->orWhere('prenom', 'like', $searchTerm)
                    ->orWhere('telephone', 'like', $searchTerm)
                    ->orWhere('courriel', 'like', $searchTerm)
                    ->orWhereHas('entreprise', function($q2) use ($searchTerm) {
                        $q2->where('nom', 'like', $searchTerm);
                    });
            });
        }

        $contacts = $query->paginate(10);

        return view('livewire.dashboard.contacts-list', compact('contacts'));
    }
}
