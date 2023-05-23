<?php

namespace App\Models;
use App\Models\Level;
use App\Models\Admin;
use App\Models\Mentor;
use App\Models\Attainment;
use App\Models\Participant;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [ 'id' ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attainments() {
        return $this->hasMany( Attainment::class, 'user_id' );
    }

    public function admins() {
        return $this->hasOne( Admin::class );
    }

    public function participants() {
        return $this->hasOne( Participant::class, 'user_id' );
    }

    public function mentors() {
        return $this->hasOne( Mentor::class );
    }

    public function levels() {
        return $this->belongsTo( Level::class, 'level_id' );
    }
}