<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model {
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function users() {

        return $this->belongsTo( User::class, 'id_user' );
    }
}
