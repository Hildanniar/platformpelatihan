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
        User::factory( 10 )->create();
        Participant::factory( 10 )->create();
        Mentor::factory( 10 )->create();
        Material::factory( 10 )->create();
        TypeTraining::factory( 10 )->create();
        Schedule::factory( 10 )->create();
        Attainment::factory( 10 )->create();
        Certificate::factory( 10 )->create();
        Survey::factory( 10 )->create();
        Task::factory( 10 )->create();
        Level::create([
                'name' => 'Superadmin'
            ]);
        Level::create([
                'name' => 'Mentor'
            ]);
        Level::create([
                'name' => 'Peserta'
            ]); 

    }
}
