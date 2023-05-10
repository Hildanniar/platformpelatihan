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

    public function ProfileUpdate() {
        if ( Auth::user() ) {
            $user = User::find( Auth::user()->id );
            if ( $user ) {
                return view( 'participants.profile.edit', compact( 'user' ) );
            }
        }
    }

    public function UpdateProfileParticipant( Request $request ) {

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
            if ( auth()->user()->levels->name == 'Peserta' ) {
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
                    $data_participant = [
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
                    $data_participant = [
                        'name'=> $validatedData[ 'name' ],
                        'address'=> $validatedData[ 'address' ],
                        'age'=> $validatedData[ 'age' ],
                        'no_hp'=> $validatedData[ 'no_hp' ],
                        'gender'=> $validatedData[ 'gender' ],
                        'profession'=> $validatedData[ 'profession' ],
                        'no_member'=> $validatedData[ 'no_member' ],
                    ];
                }
                $user->participants()->update( $data_participant );
                $user->update( $data_user );
            }
            return Redirect()->back()->with( 'success', 'Profile Berhasil diupdate!!!' );
        } else {
            return Redirect()->back();
        }
    }

}