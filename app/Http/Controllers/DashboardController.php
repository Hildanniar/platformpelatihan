<?php

namespace App\Http\Controllers;

use App\Models\Attainment;
use App\Models\MateriTask;
use App\Models\Schedule;
use App\Models\User;
use App\Models\TypeTraining;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller {
    public function dashboardAdmin() {
        //dashboard admin dan mentor
        $users = User::where( 'level_id', '3' )->count();
        $type_trainings = TypeTraining::count();
        $attainments = Attainment::count();
        return view( 'admin.dashboard.index', compact( 'users', 'type_trainings', 'attainments' ) );
    }

    public function dashboardPublic() {
        $attainment = Attainment::orderBy( 'created_at', 'desc' )->where( 'status', 'Publikasi' )->limit( 5 )->latest()->get();
        $typeTrainings = TypeTraining::limit( 5 )->get();
        //dashboard tanpa login
        $users = User::where( 'level_id', '3' )->count();
        $type_trainings = TypeTraining::count();
        $attainments = Attainment::count();
        return view( 'dashboard.layouts.main', compact( 'users', 'type_trainings', 'attainments', 'attainment', 'typeTrainings' ) );
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
        // $schedules = Schedule::where( 'type_training_id', $type_training->id )->get();
        $attainments = Attainment::where( 'status', 'Publikasi' )->latest()->paginate( 6 );
        // $materi_tasks = MateriTask::all();
        // dd( $attainments->image );
        return view( 'dashboard.layouts.public.attainment', [
            'attainments' => $attainments,
            // 'schedules' => $schedules,
            // 'materi_tasks '=>$materi_tasks
        ] );
    }

    public function show_attainment( Attainment $attainment ) {
        // dd( $attainment->users );
        return view( 'dashboard.layouts.public.show_attainment', [
            'attainment' => $attainment,
        ] );
    }

    public function trainings() {
        $typeTrainings = TypeTraining::latest()->paginate( 6 );
        return view( 'dashboard.layouts.public.training', [
            'typeTrainings' => $typeTrainings,
        ] );
    }

    public function show_training( TypeTraining $type_training ) {
        $schedules = Schedule::where( 'type_training_id', $type_training->id )->get();
        return view( 'dashboard.layouts.public.show_training', [
            'type_training' => $type_training,
            'schedules' => $schedules
        ] );
    }

    public function PUpdate() {
        if ( Auth::user() ) {
            $user = User::find( Auth::user()->id );
            if ( $user ) {
                return view( 'admin.profile.edit', compact( 'user' ) );
            }
        }
    }

    public function UpdateProfile( Request $request ) {

        $rules =  [
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,'.auth()->user()->id.'|max:255',
            'email' => 'required',
            'password'=>'nullable',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'required|max:255',
            'image' => 'image|file|max:2048',

        ] ;
        $validatedData = $request->validate( $rules );
        $user = User::find( Auth::user()->id );
        if ( $user ) {
            if ( auth()->user()->levels->name == 'Admin' ) {
                $data_user = [
                    'username'=> $validatedData[ 'username' ],
                    'email'=> $validatedData[ 'email' ],
                    'password'=> bcrypt( $validatedData[ 'password' ] ),
                ];
                if ( $request->file( 'image' ) ) {
                    if ( $request->oldImage ) {
                        Storage::delete( $request->oldImage );
                    }
                    $validatedData[ 'image' ] = $request->file( 'image' )->store( 'profile-photos' );
                    $data_admin = [
                        'name'=> $validatedData[ 'name' ],
                        'address'=> $validatedData[ 'address' ],
                        'age'=> $validatedData[ 'age' ],
                        'no_hp'=> $validatedData[ 'no_hp' ],
                        'gender'=> $validatedData[ 'gender' ],
                        'profession'=> $validatedData[ 'profession' ],
                        'no_member'=> $validatedData[ 'no_member' ],
                        'image'=> $validatedData[ 'image' ],
                    ];
                } else {
                    $data_admin = [
                        'name'=> $validatedData[ 'name' ],
                        'address'=> $validatedData[ 'address' ],
                        'age'=> $validatedData[ 'age' ],
                        'no_hp'=> $validatedData[ 'no_hp' ],
                        'gender'=> $validatedData[ 'gender' ],
                        'profession'=> $validatedData[ 'profession' ],
                        'no_member'=> $validatedData[ 'no_member' ],
                    ];
                }
                $user->admins()->update( $data_admin );
                $user->update( $data_user );
            } elseif ( auth()->user()->levels->name == 'Mentor' ) {
                $data_user = [
                    'username'=> $validatedData[ 'username' ],
                    'email'=> $validatedData[ 'email' ],
                    'password'=> bcrypt( $validatedData[ 'password' ] ),
                ];
                if ( $request->file( 'image' ) ) {
                    if ( $request->oldImage ) {
                        Storage::delete( $request->oldImage );
                    }
                    $validatedData[ 'image' ] = $request->file( 'image' )->store( 'profile-photos' );
                    $data_mentor = [
                        'name'=> $validatedData[ 'name' ],
                        'address'=> $validatedData[ 'address' ],
                        'age'=> $validatedData[ 'age' ],
                        'no_hp'=> $validatedData[ 'no_hp' ],
                        'gender'=> $validatedData[ 'gender' ],
                        'profession'=> $validatedData[ 'profession' ],
                        'no_member'=> $validatedData[ 'no_member' ],
                        'image'=> $validatedData[ 'image' ],
                    ];
                } else {
                    $data_mentor = [
                        'name'=> $validatedData[ 'name' ],
                        'address'=> $validatedData[ 'address' ],
                        'age'=> $validatedData[ 'age' ],
                        'no_hp'=> $validatedData[ 'no_hp' ],
                        'gender'=> $validatedData[ 'gender' ],
                        'profession'=> $validatedData[ 'profession' ],
                        'no_member'=> $validatedData[ 'no_member' ],
                    ];
                }
                $user->mentors()->update( $data_mentor );
                $user->update( $data_user );
            }
            return Redirect()->back()->with( 'success', 'Profile Berhasil diupdate!!!' );
        } else {
            return Redirect()->back();
        }
    }
}