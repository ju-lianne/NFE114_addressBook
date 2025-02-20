<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\Entreprises;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    protected $model = Entreprise::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
        ];
    }
}
