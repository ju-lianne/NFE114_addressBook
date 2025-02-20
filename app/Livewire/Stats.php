<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Auth;

class Stats extends Component
{
    public $contactsCount;
    public $favoritesCount;
    public $entreprisesCount;

    public function render()
    {
        $this->contactsCount = Contact::count();
        $this->entreprisesCount = Entreprise::count();
        if (Auth::check()) {
            $this->favoritesCount = Auth::user()->favoris()->count();
        } else {
            $this->favoritesCount = 0;
        }
        return view('livewire.dashboard.stats');
    }
}
