<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Entreprise;

class CreateEntreprise extends Component
{
    public $nom;

    protected $rules = [
        'nom' => 'required|string|max:255',
    ];

    public function submit()
    {
        $this->validate();

        Entreprise::create([
            'nom' => $this->nom,
        ]);

        session()->flash('message', 'Entreprise créée avec succès.');

        $this->reset('nom');
    }

    public function render()
    {
        return view('livewire.create-entreprise');
    }
}
