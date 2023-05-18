<?php

namespace App\Models;

use App\Models\TypeTraining;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function type_trainings() {
        return $this->belongsTo( TypeTraining::class, 'type_training_id' );
    }

    public function participants() {
        return $this->hasMany( Participant::class );
    }
}