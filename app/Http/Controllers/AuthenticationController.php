<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthenticationController extends Controller {

    public function index() {
        return view( 'authentication.login' );
    }

    public function login( Request $request ) {
        $validatedData = $request->validate( [
            'emailandusername' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ] );

        if ( filter_var( $validatedData[ 'emailandusername' ], FILTER_VALIDATE_EMAIL ) ) {
            $credentialData = [
                'email' => $validatedData[ 'emailandusername' ],
                'password' => $validatedData[ 'password' ],
            ];
        } else {
            $credentialData = [
                'username' => $validatedData[ 'emailandusername' ],
                'password' => $validatedData[ 'password' ],
            ];
        }

        if ( Auth::attempt( $credentialData ) ) {
            $request->session()->regenerate();

            if ( auth()->user()->levels->name === 'Peserta' ) {
                return redirect()->intended( '/peserta' );
            }
            return redirect()->intended( '/admin' );
        }
        return back()->with( 'login_error', 'Masuk Gagal, Pastikan Username dan Password Anda Benar!!!' );
    }

    public function reloadcaptcha() {
        return response()->json( [ 'captcha' => captcha_img() ] );
    }

    public function logout( Request $request ) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect( '/' );
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
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required',
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
            if ( auth()->user()->levels->name == 'Mentor' || 'Admin' ) {
                if ( $request->password != null ) {
                    $data_user = [
                        'level_id' => 2,
                        'username'=> $validatedData[ 'username' ],
                        'email'=> $validatedData[ 'email' ],
                        'password'=> bcrypt( $validatedData[ 'password' ] ),
                    ];
                } else {
                    $data_user = [
                        'level_id' => 2,
                        'username'=> $validatedData[ 'username' ],
                        'email'=> $validatedData[ 'email' ],

                    ];
                }
                $data_mentor = [
                    'name'=> $validatedData[ 'name' ],
                    'address'=> $validatedData[ 'address' ],
                    'age'=> $validatedData[ 'age' ],
                    'no_hp'=> $validatedData[ 'no_hp' ],
                    'gender'=> $validatedData[ 'gender' ],
                    'profession'=> $validatedData[ 'profession' ],
                    'no_member'=> $validatedData[ 'no_member' ],
                    // 'image'=> $validatedData[ 'image' ],
                ];
                $user->mentors()->update( $data_mentor );
                $user->update( $data_user );
            } else {
                if ( $request->password != null ) {
                    $data_user = [
                        'username'=> $validatedData[ 'username' ],
                        'email'=> $validatedData[ 'email' ],
                        'password'=> bcrypt( $validatedData[ 'password' ] ),
                    ];
                } else {
                    $data_user = [
                        'username'=> $validatedData[ 'username' ],
                        'email'=> $validatedData[ 'email' ],
                    ];
                }
                $data_participant = [
                    'name'=> $validatedData[ 'name' ],
                    'address'=> $validatedData[ 'address' ],
                    'age'=> $validatedData[ 'age' ],
                    'no_hp'=> $validatedData[ 'no_hp' ],
                    'gender'=> $validatedData[ 'gender' ],
                    'profession'=> $validatedData[ 'profession' ],
                    'no_member'=> $validatedData[ 'no_member' ],
                    // 'image'=> $validatedData[ 'image' ],
                ];
                $user->participants()->update( $data_participant );
                $user->update( $data_user );
            }
            return Redirect()->back()->with( 'success', 'Profile Berhasil diupdate!!!' );
        } else {
            return Redirect()->back();
        }
    }
}