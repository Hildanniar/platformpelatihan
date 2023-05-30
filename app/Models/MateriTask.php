<?php

namespace App\Models;
use App\Models\TypeTraining;
use App\Models\Attainment;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriTask extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function type_trainings() {
        return $this->belongsTo( TypeTraining::class, 'type_training_id' );
    }

    public function participants() {
        return $this->hasMany( Participant::class );
    }

    public function attainments() {
        return $this->hasMany( Attainment::class, 'materi_task_id' );
    }

}