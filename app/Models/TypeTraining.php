<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Material;
use App\Models\Schedule;
use App\Models\Attainment;
use App\Models\Certificate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeTraining extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function materials() {
        return $this->hasMany( Material::class );
    }

    public function tasks() {
        return $this->belongsTo( Task::class );
    }

    public function certificate() {
        return $this->belongsTo( Certificate::class );
    }

    public function schedules() {
        return $this->hasMany( Schedule::class );
    }

    public function attainmnet() {
        return $this->hasMany( Attainment::class );
    }
}
