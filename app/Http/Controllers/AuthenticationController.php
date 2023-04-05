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
        $user = User::find( Auth::user()->id );
        if ( $user ) {
            $user->name = $request[ 'name' ];
            $user->email = $request[ 'email' ];
            $user->username = $request[ 'username' ];
            $user->no_hp = $request[ 'no_hp' ];
            $user->no_member = $request[ 'no_member' ];
            $user->gender = $request[ 'gender' ];
            $user->profession = $request[ 'profession' ];
            $user->age = $request[ 'age' ];
            $user->address = $request[ 'address' ];

            $user->save();
            return Redirect()->back()->with( 'success', 'Profile Berhasil diupdate!!!' );
        } else {
            return Redirect()->back();
        }
    }
}
