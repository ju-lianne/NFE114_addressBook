<?php

namespace Database\Factories;

use App\Models\Utilisateurs;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;

class UtilisateursFactory extends Factory
{
    protected $model = Utilisateurs::class;

    public function definition()
    {
        $roleIds = Roles::pluck('id')->toArray();
        $role_id = null;
        if (!empty($roleIds)) {
            $role_id = $this->faker->randomElement($roleIds);
        }

        return [
            'dateNaiss' => $this->faker->date(),
            'role_id'   => $role_id,
        ];
    }
}
