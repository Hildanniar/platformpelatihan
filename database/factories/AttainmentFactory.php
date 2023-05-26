<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttainmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_training_id' => mt_rand(1, 3),
            'participant_id' => mt_rand(11,15),
            'materi_task_id' => mt_rand(1, 3),
            'link' => $this->faker->paragraph(),
            'excerpt' => $this->faker->paragraph(),
            'desc' => '<p>' . implode('<p></p>', $this->faker->paragraphs(mt_rand(5,10))). '</p>',
            // 'value' => $this->faker->numerify('##'),
            'status' => ['NoPublikasi', 'Publikasi'][mt_rand(0,1)],
            'is_active' => ['0', '1'][mt_rand(0,1)],
        ];
    }
}