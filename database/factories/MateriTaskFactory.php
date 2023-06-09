<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MateriTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_training_id' => mt_rand(1, 5),
            'name_materi' => $this->faker->name(),
            'bab_materi' => ['BAB I', 'BAB II', 'BAB III'][mt_rand(0,1)],
            'excerpt_materi' => $this->faker->paragraph(),
            'body_materi' => '<p>' . implode('<p></p>', $this->faker->paragraphs(mt_rand(5,10))). '</p>',
            // 'file_materi' => $this->faker->nullable(),
            'name_task' => $this->faker->name(),
            'start_date' => $this->faker->date('Y-m-d'),
            'end_date' => $this->faker->date('Y-m-d'),
            'desc_task' => '<p>' . implode('<p></p>', $this->faker->paragraphs(mt_rand(5,10))). '</p>',
            'is_active' => ['0', '1'][mt_rand(0,1)],
        ];
    }
}