<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Categories;
use App\Models\Contact;
use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        $categorieIds = Categorie::pluck('id')->toArray();
        $categorie_id = null;
        if (!empty($categorieIds)) {
            $categorie_id = $this->faker->randomElement($categorieIds);
        }

        return [
            'categorie_id' => $categorie_id,
        ];
    }
}
