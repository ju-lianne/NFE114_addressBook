<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'libelle' => $this->faker->word,
        ];
    }
}
