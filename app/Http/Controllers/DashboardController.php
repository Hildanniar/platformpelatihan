<?php

namespace App\Http\Controllers;

use App\Models\Attainment;
use App\Models\User;
use App\Models\TypeTraining;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    public function index() {
        $users = User::where( 'level_id', '3' )->count();
        $type_trainings = TypeTraining::count();
        $attainments = Attainment::count();
        return view( 'admin.dashboard.index', compact( 'users', 'type_trainings', 'attainments' ) );
    }

    public function dashboard() {
        $users = User::where( 'level_id', '3' )->count();
        $type_trainings = TypeTraining::count();
        $attainments = Attainment::count();
        return view( 'dashboard.layouts.main', compact( 'users', 'type_trainings', 'attainments' ) );
    }

    public function survey( Request $request ) {
        $validatedData = $request->validate( [
            'name' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'profession' => 'required',
            'quota' => 'required|numeric',
            'type_training' => 'required',
            'month' => 'required',
            'excuse' => 'required'
        ] );
        Survey::create( $validatedData );
        return redirect( '/' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    public function about() {
        return view( 'dashboard.layouts.public.about' );
    }

    public function attainment() {
        return view( 'dashboard.layouts.public.attainment' );
    }

    public function training() {
        return view( 'dashboard.layouts.public.training' );
    }
}