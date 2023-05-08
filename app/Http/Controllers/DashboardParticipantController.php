<?php

namespace App\Http\Controllers;

use App\Models\Attainment;
use App\Models\User;
use App\Models\TypeTraining;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardParticipantController extends Controller {
    public function index() {
        $users = User::where( 'level_id', '3' )->count();
        $type_trainings = TypeTraining::count();
        $attainments = Attainment::count();
        return view( 'dashboard.layouts.participants.main', compact( 'users', 'type_trainings', 'attainments' ) );
    }

    public function start() {
        return view( 'participants.layouts.index' );
    }

    public function about() {
        return view( 'dashboard.layouts.public.about' );
    }

    public function attainment() {
        return view( 'dashboard.layouts.public.attainment' );
    }

    public function type_training() {
        return view( 'dashboard.layouts.public.training' );
    }

    public function PUpdate() {
        if ( Auth::user() ) {
            $user = User::find( Auth::user()->id );
            if ( $user ) {
                return view( 'admin.profile.edit', compact( 'user' ) );
            }
        }
    }

}