<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        return view( 'admin.pengguna.index', [
            'users' => User::all()
        ] );

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.pengguna.create' );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {

        $validatedData = $request->validate( [
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'required|max:255'
        ] );
        $validatedData[ 'id_level' ] = 2;
        $validatedData[ 'password' ] = bcrypt( $request->password );
        User::create( $validatedData );
        return redirect( '/admin/pengguna' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( User $pengguna ) {
        return view( 'admin.pengguna.show', [
            'user' => $pengguna,
        ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( User $pengguna ) {
        return view( 'admin.pengguna.edit', [
            'user' => $pengguna,
        ] );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, User $pengguna ) {
        $rules =  [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'required|max:255'
        ] ;
        if ( $request->username != $pengguna->username ) {
            $rules[ 'username' ] = 'required|unique:users|max:255';
        }
        if ( $request->email != $pengguna->email ) {
            $rules[ 'email' ] = 'required|unique:users';
        }

        if ( $request-> password == null ) {
            $validatedData = $request->validate( $rules );
            $validatedData[ 'id_level' ] = 2;
            User::where( 'id', $pengguna->id )
            ->update( $validatedData );
        } else {
            $validatedData = $request->validate( $rules );
            $validatedData[ 'id_level' ] = 2;
            $validatedData[ 'password' ] = bcrypt( $request->password );
            User::where( 'id', $pengguna->id )
            ->update( $validatedData );
        }
        return redirect( '/admin/pengguna' )->with( 'success', 'Data Berhasil Diupdate!' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( User $pengguna ) {
        User::destroy( $pengguna->id );
        return redirect( '/admin/pengguna' )->with( 'success', 'Data berhasil dihapus!' );
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/pengguna/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/pengguna/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                </form>
                     <a href="/admin/pengguna/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                     
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function export_excel() {
        return Excel::download( new UserExport, 'pengguna.xlsx' );
    }

    public function export_pdf() {
        // $data = Participant::orderBy( 'name' )->get();
        // $pdf = PDF::loadView( 'participant.export_pdf' );
        // return $pdf->stream();
        $user = User::get();
        $pdf = PDF::loadView( 'admin.pdf.user', ['users' => $user] )
        ->setPaper('a4', 'landscape');
        // return $pdf->download( 'peserta.pdf' );
        return $pdf->stream();
    }
}
