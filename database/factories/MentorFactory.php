<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MentorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => mt_rand(1, 4),
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->username(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'no_hp' => $this->faker->numerify('08#########'),
            'is_active' =>['0', '1'][mt_rand(0,1)]
        ];
    }
}
