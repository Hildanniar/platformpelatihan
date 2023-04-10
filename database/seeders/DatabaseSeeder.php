<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Level;
use App\Models\Mentor;
use App\Models\Survey;
use App\Models\MateriTask;
use App\Models\Schedule;
use App\Models\Attainment;
use App\Models\Certificate;
use App\Models\Participant;
use Faker\Factory as Faker;
use App\Models\TypeTraining;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {

        User::factory( 11 )->create();
        Participant::factory( 5 )->create();
        Mentor::factory( 5 )->create();
        MateriTask::factory( 5 )->create();
        TypeTraining::factory( 5 )->create();
        Schedule::factory( 5 )->create();
        Attainment::factory( 5 )->create();
        Certificate::factory( 2 )->create();
        Survey::factory( 5 )->create();
        Level::create( [
            'name' => 'Admin'
        ] );
        Level::create( [
            'name' => 'Mentor'
        ] );
        Level::create( [
            'name' => 'Peserta'
        ] );

    }
}
