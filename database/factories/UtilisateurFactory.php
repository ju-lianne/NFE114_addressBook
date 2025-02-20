<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Utilisateur;
use App\Models\Utilisateurs;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;

class UtilisateurFactory extends Factory
{
    protected $model = Utilisateur::class;

    public function definition()
    {
        $roleIds = Role::pluck('id')->toArray();
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
