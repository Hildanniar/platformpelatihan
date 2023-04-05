<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_training_id' => mt_rand(1, 4),
            'id_user' => mt_rand(1, 4),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'no_hp' => $this->faker->numerify('08#########'),
            'class' => ['Offline', 'Online'][mt_rand(0,1)],
            'is_active' =>['0', '1'][mt_rand(0,1)]
            
        ];
    }
}
