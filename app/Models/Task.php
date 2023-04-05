<?php

namespace App\Models;

use App\Models\TypeTraining;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function type_trainings() {
        return $this->belongsTo( TypeTraining::class, 'type_training_id' );
    }
}
