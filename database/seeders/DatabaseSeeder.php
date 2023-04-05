<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Level;
use App\Models\Mentor;
use App\Models\Survey;
use App\Models\Material;
use App\Models\Schedule;
use App\Models\Attainment;
use App\Models\Certificate;
use App\Models\Participant;
use Faker\Factory as Faker;
use App\Models\TypeTraining;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
    * Seed the application's database.
    *
    * @return void
    */

    public function run() {
        // $faker = Faker::create('id_ID');
        // \App\Models\User::factory( 10 )->create();
        User::factory( 4 )->create();
        Participant::factory( 4 )->create();
        Mentor::factory( 4 )->create();
        Material::factory( 4 )->create();
        TypeTraining::factory( 4 )->create();
        Schedule::factory( 4 )->create();
        Attainment::factory( 4 )->create();
        Certificate::factory( 4 )->create();
        Survey::factory( 4 )->create();
        Task::factory( 4 )->create();
        Level::create([
                'name' => 'Admin'
            ]);
        Level::create([
                'name' => 'Mentor'
            ]);
        Level::create([
                'name' => 'Peserta'
            ]); 

    }
}
