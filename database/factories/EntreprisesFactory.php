<?php

namespace Database\Factories;

use App\Models\Entreprises;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntreprisesFactory extends Factory
{
    protected $model = Entreprises::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
        ];
    }
}
