<?php

namespace App\Models;

use App\Models\MateriTask;
use App\Models\Schedule;
use App\Models\Attainment;
use App\Models\Certificate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeTraining extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function materi_tasks() {
        return $this->hasMany( MateriTask::class );
    }

    public function certificates() {
        return $this->hasOne( Certificate::class, 'type_training_id' );
    }

    public function schedules() {
        return $this->hasMany( Schedule::class, 'type_training_id' );
    }

    public function attainment() {
        return $this->hasMany( Attainment::class );
    }

    // public function participants() {
    //     return $this->hasMany( Participant::class );
    // }

    public function training_participants() {
        return $this->hasMany( Participant::class, 'type_training_id' );
    }
}