<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeTrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'class' => ['Offline', 'Online'][mt_rand(0,1)],
            'quota' => $this->faker->numerify('2'),
            'excerpt' => $this->faker->paragraph(),
            'desc' => '<p>' . implode('<p></p>', $this->faker->paragraphs(mt_rand(5,10))). '</p>',
        ];
    }
}
