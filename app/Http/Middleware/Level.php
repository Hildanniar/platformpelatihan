<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Level {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure( \Illuminate\Http\Request ): ( \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse )  $next
    * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    */

    public function handle( Request $request, Closure $next ) {
        if ( !auth()->check() ) {
            return redirect()->route( 'login' )->with( 'login_error', 'Silahkan Masuk Terlebih Dahulu' );
        }

        if ( auth()->user()->levels->name === 'Peserta' ) {
            return redirect()->route( 'login' )->with( 'login_error', 'Masuk Gagal, Khusus untuk Admin dan Mentor' );
        }

        return $next( $request );

    }
}
