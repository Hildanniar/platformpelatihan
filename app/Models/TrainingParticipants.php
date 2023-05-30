<?php

namespace App\Models;
use App\Models\Attainment;
use App\Models\TypeTraining;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingParticipants extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function participants() {
        return $this->belongsTo( Participant::class, 'participant_id' );
    }

    public function type_trainings() {
        return $this->belongsTo( TypeTraining::class, 'type_training_id' );
    }

    // public function attainments() {
    //     return $this->hasMany( Attainment::class, 'participant_id' );
    // }
}