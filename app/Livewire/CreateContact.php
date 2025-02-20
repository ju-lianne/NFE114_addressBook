<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Entreprise;
use App\Models\Categorie;
use App\Models\Personne;
use App\Models\Contact;

class CreateContact extends Component
{
    public $name;
    public $surname;
    public $phone;
    public $email;
    public $entreprise_id;
    public $categorie_id;

    public $entreprises;
    public $categories;

    protected $rules = [
        'name'           => 'required|string',
        'surname'        => 'required|string',
        'phone'          => 'nullable|string',
        'email'          => 'nullable|email',
        'entreprise_id'  => 'required|exists:entreprises,id',
        'categorie_id'   => 'required|exists:categories,id',
    ];

    public function mount()
    {
        $this->entreprises = Entreprise::all();
        $this->categories = Categorie::all();
    }

    public function submit()
    {
        $this->validate();

        $personne = Personne::create([
            'prenom'        => $this->name,
            'nom'           => $this->surname,
            'telephone'     => $this->phone,
            'courriel'      => $this->email,
            'entreprise_id' => $this->entreprise_id,
        ]);

        Contact::create([
            'id' => $personne->id,
            'categorie_id'  => $this->categorie_id,
        ]);

        session()->flash('message', 'Contact créé avec succès.');

        $this->reset(['name', 'surname', 'phone', 'email', 'entreprise_id', 'categorie_id']);
    }

    public function render()
    {
        return view('livewire.create-contact');
    }
}
