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
        $users = User::where( 'id_level', '3' )->count();
        $type_trainings = TypeTraining::count();
        $attainments = Attainment::count();
        return view( 'admin.dashboard.index', compact( 'users', 'type_trainings', 'attainments' ) );
    }

    public function dashboard() {
        $users = User::where( 'id_level', '3' )->count();
        $type_trainings = TypeTraining::count();
        $attainments = Attainment::count();
        return view( 'dashboard.layouts.main', compact( 'users', 'type_trainings', 'attainments' ) );
    }

    public function survey( Request $request ) {
        // DB::table( 'surveys' )->insert( [
        //     'name' => $request->name,
        //     'age' => $request->age,
        //     'city' => $request->city,
        //     'profession' => $request->profession,
        //     'type_training' => $request->type_training,
        //     'month' => $request->month,
        //     'excuse' => $request->excuse
        // ] );
        // // alihkan halaman ke halaman pegawai
        // return redirect( '/' );

        $validatedData = $request->validate( [
            'name' => 'required',
            'age' => 'required',
            'city' => 'required',
            'profession' => 'required',
            'type_training' => 'required',
            'month' => 'required',
            'excuse' => 'required'
        ] );
        Survey::create( $validatedData );
        return redirect( '/' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }
}
