<?php

namespace App\Models;
use App\Models\User;
use App\Models\Participant;
use App\Models\TypeTraining;
use App\Models\MateriTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attainment extends Model {
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function type_trainings() {
        return $this->belongsTo( TypeTraining::class, 'type_training_id' );
    }

    // public function users() {
    //     return $this->belongsTo( User::class, 'user_id' );
    // }

    public function participants() {
        return $this->belongsTo( Participant::class, 'participant_id' );
    }

    public function materi_tasks() {
        return $this->belongsTo( MateriTask::class, 'materi_task_id' );
    }
}