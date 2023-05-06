<?php

namespace App\Http\Controllers;

use App\Models\Attainment;
use App\Models\User;
use App\Models\TypeTraining;
use App\Models\Survey;
use Illuminate\Http\Request;

class DashboardParticipantController extends Controller {
    public function index() {
        $users = User::where( 'level_id', '3' )->count();
        $type_trainings = TypeTraining::count();
        $attainments = Attainment::count();
        return view( 'dashboard.layouts.participants.main', compact( 'users', 'type_trainings', 'attainments' ) );
    }

    public function start() {
        return view( 'participants.layouts.main' );
    }
}