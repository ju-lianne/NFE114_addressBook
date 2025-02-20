<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contact;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;

class FavoriteContactsList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategories = [];
    public $userFavoris = [];

    protected $paginationTheme = 'tailwind';
    protected $queryString = ['search'];

    public function mount()
    {
        if (Auth::check()) {
            // Récupère les IDs des contacts favoris de l'utilisateur
            $this->userFavoris = Auth::user()->favoris()->pluck('contact_id')->toArray();
        } else {
            $this->userFavoris = [];
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategories()
    {
        $this->resetPage();
    }

    public function toggleFavorite($contactId)
    {
        $user = Auth::user();
        if (!$user) {
            session()->flash('error', 'Vous devez être connecté pour ajouter des favoris.');
            return;
        }

        if ($user->favoris()->where('contact_id', $contactId)->exists()) {
            $user->favoris()->detach($contactId);
            session()->flash('message', 'Favori retiré.');
        } else {
            $user->favoris()->attach($contactId);
            session()->flash('message', 'Favori ajouté.');
        }
        // Met à jour la liste des favoris après modification
        $this->userFavoris = $user->favoris()->pluck('contact_id')->toArray();
    }

    public function highlight($text, $search)
    {
        if (!$search) {
            return e($text);
        }
        $escaped = e($text);
        return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<span class="bg-yellow-200">$1</span>', $escaped);
    }

    public function render()
    {
        $categories = Categorie::all();

        // Récupère uniquement les contacts dont l'id figure dans la liste des favoris de l'utilisateur
        $contacts = Contact::with(['personne.entreprise', 'categorie'])
            ->whereIn('id', $this->userFavoris)
            ->when($this->search, function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->whereHas('personne', function ($q) use ($searchTerm) {
                    $q->where('nom', 'like', $searchTerm)
                        ->orWhere('prenom', 'like', $searchTerm)
                        ->orWhere('telephone', 'like', $searchTerm)
                        ->orWhere('courriel', 'like', $searchTerm)
                        ->orWhereHas('entreprise', function ($q2) use ($searchTerm) {
                            $q2->where('nom', 'like', $searchTerm);
                        });
                });
            })
            ->when(!empty($this->selectedCategories), function ($query) {
                $query->whereHas('categorie', function ($q) {
                    $q->whereIn('id', $this->selectedCategories);
                });
            })
            ->paginate(10);

        return view('livewire.dashboard.favorite-contacts-list', [
            'contacts'    => $contacts,
            'categories'  => $categories,
            'userFavoris' => $this->userFavoris,
        ]);
    }
}
