<?php

namespace Database\Factories;

use App\Models\Entreprises;
use App\Models\Personnes;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonnesFactory extends Factory
{
    protected $model = Personnes::class;

    public function definition()
    {
        $entrepriseIds = Entreprises::pluck('id')->toArray();
        $entreprise_id = null;
        if (!empty($entrepriseIds) && $this->faker->boolean(50)) {
            $entreprise_id = $this->faker->randomElement($entrepriseIds);
        }

        return [
            'nom'           => $this->faker->lastName,
            'prenom'        => $this->faker->firstName,
            'telephone'     => $this->faker->phoneNumber,
            'courriel'      => $this->faker->unique()->safeEmail,
            'entreprise_id' => $entreprise_id,
        ];
    }
}
