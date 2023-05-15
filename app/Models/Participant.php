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
        return $this->hasMany( Attainment::class, 'user_id' );
    }

    public function trainings() {
        return $this->hasMany( TypeTraining::class, 'type_training_id' );
    }
}