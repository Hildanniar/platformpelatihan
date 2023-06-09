<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyFactory extends Factory
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
            'age' => mt_rand(20, 100),
            'address' => $this->faker->address(),
            'profession' => $this->faker->jobTitle(),
            'quota' => $this->faker->numerify('#'),
            'type_training' => $this->faker->word(),
            'month' => ['Januari', 'Februari', 'Maret', 'April',' Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][mt_rand(0,1)],
            'excuse' => $this->faker->text(),
        ];
    }
}
