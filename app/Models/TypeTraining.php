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

    public function certificate() {
        return $this->belongsTo( Certificate::class );
    }

    public function schedules() {
        return $this->hasMany( Schedule::class );
    }

    public function attainment() {
        return $this->hasMany( Attainment::class );
    }
}