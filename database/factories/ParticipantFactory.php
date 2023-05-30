<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory {
    public function definition() {
        return [
            'user_id' => mt_rand( 7, 10 ),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'age' => mt_rand( 20, 100 ),
            'no_hp' => $this->faker->numerify( '08#########' ),
            'gender' => [ 'Laki-Laki', 'Perempuan' ][ mt_rand( 0, 1 ) ],
            'profession' => $this->faker->jobTitle(),
            'no_member' => $this->faker->randomNumber( 5, true ),
            'comment' => '<p>' . implode( '<p></p>', $this->faker->paragraphs( mt_rand( 1, 2 ) ) ). '</p>',
            'is_active' =>[ '0', '1' ][ mt_rand( 0, 1 ) ],

        ];
    }
}