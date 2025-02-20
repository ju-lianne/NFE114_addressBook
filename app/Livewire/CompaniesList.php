<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Entreprise;

class CompaniesList extends Component
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
        $entreprises = Entreprise::when($this->search, function ($query) {
            $query->where('nom', 'like', '%' . $this->search . '%');
        })->withCount('personnes')->paginate(10);

        return view('livewire.dashboard.companies-list', [
            'entreprises' => $entreprises,
        ]);
    }
}
