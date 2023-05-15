<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuParticipantController extends Controller {
    public function schedule() {
        return view( 'participants.schedule.index' );
    }

    public function attainment() {
        return view( 'participants.attainment.index' );
    }
}