<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function users() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function attainments() {
        return $this->hasMany( Attainment::class, 'participant_id' );
    }

    public function training_participants() {
        return $this->hasMany( TrainingParticipants::class, 'participant_id' );
    }

    public function type_trainings() {
        return $this->belongsTo( TypeTraining::class, 'type_training_id' );
    }

    public function schedules() {
        return $this->hasMany( Schedule::class );
    }

    public function materi_tasks() {
        return $this->hasMany( MateriTask::class );
    }
}