<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingParticipants extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function participants() {
        return $this->belongsTo( Participant::class, 'participant_id' );
    }

    public function type_trainings() {
        return $this->belongsTo( TrainingParticipants::class, 'type_training_id' );
    }
}