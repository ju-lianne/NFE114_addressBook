<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactsFactory extends Factory
{
    protected $model = Contacts::class;

    public function definition()
    {
        $categorieIds = Categories::pluck('id')->toArray();
        $categorie_id = null;
        if (!empty($categorieIds)) {
            $categorie_id = $this->faker->randomElement($categorieIds);
        }

        return [
            'categorie_id' => $categorie_id,
        ];
    }
}
