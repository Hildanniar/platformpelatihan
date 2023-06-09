<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Level;
use App\Models\Participant;
use Exception;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller {

    public function register() {
        return view( 'authentication.register', [
            'levels' => Level::all(),
            'users' => User::all(),
        ] );
    }

    public function actionregister( Request $request ) {
        // dd( $request );
        try {
            $validatedData = $request->validate( [
                'username' => 'required|unique:users|max:255',
                'email' => 'required',
                'password' => 'required',
            ] );
            $data_user = [
                'level_id' => '3',
                'username'=> $validatedData[ 'username' ],
                'email'=> $validatedData[ 'email' ],
                'password'=> bcrypt( $validatedData[ 'password' ] ),
                'is_active' => '1',
            ];
            $user = User::create( $data_user );
            $user_last_id = $user->id;
            $data_participant = [
                'type_training_id'=> null,
                'user_id' => $user_last_id,
                'name'=> 'Peserta Baru',
                'address'=> 'Silahkan Mengisi Alamat',
                'age'=> null,
                'no_hp'=> null,
                'gender'=> null,
                'profession'=> 'Silahkan Mengisi Pekerjaan',
                'no_member'=> 'Silahkan Mengisi No Member',
                'image'=> null,
                'class'=> null,
            ];
            Participant::create( $data_participant );
            Session::flash( 'register_success', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.' );
            return redirect( '/register' );
        } catch( Exception $error ) {
            return back()->with( 'register_error', 'Register Gagal, Email atau Username Sudah Digunakan!!!' );
        }
    }

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
                return redirect()->intended( '/dashboard/participant' );
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

}