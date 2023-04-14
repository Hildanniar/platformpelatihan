<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Mentor;
use App\Exports\MentorExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MentorController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        return view( 'admin.mentor.index');

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.mentor.create');
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
            'no_member' => 'required|max:255',
            'image' => 'image|file|max:2048',
        ] );

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-photos');

        $data_user = [
            'id_level' => 2,
            'name'=> $validatedData['name'],
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'password'=> bcrypt($validatedData['password']),
            'address'=> $validatedData['address'],
            'age'=> $validatedData['age'],
            'no_hp'=> $validatedData['no_hp'],
            'gender'=> $validatedData['gender'],
            'profession'=> $validatedData['profession'],
            'no_member'=> $validatedData['no_member'],
            'image'=> $validatedData['image'],
        ];
    } else {
        $data_user = [
            'id_level' => 2,
            'name'=> $validatedData['name'],
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'password'=> bcrypt($validatedData['password']),
            'address'=> $validatedData['address'],
            'age'=> $validatedData['age'],
            'no_hp'=> $validatedData['no_hp'],
            'gender'=> $validatedData['gender'],
            'profession'=> $validatedData['profession'],
            'no_member'=> $validatedData['no_member']
            
        ];
    }
        $user = User::create($data_user);
        $user_last_id = $user->id;
        $data_mentor = [
            'id_user' => $user_last_id,
            'name'=> $validatedData['name'],
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'address'=> $validatedData['address'],
            'no_hp'=> $validatedData['no_hp'],
        ];
        Mentor::create( $data_mentor );
        return redirect( '/admin/mentor' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Mentor  $mentor
    * @return \Illuminate\Http\Response
    */

    public function show( Mentor $mentor ) {
        return view( 'admin.mentor.show', [
            'mentor' => $mentor,
        ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Mentor  $mentor
    * @return \Illuminate\Http\Response
    */

    public function edit( Mentor $mentor ) {
        return view( 'admin.mentor.edit', [
            'mentor' => $mentor,
            'users' => User::all(),
        ] );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Mentor  $mentor
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Mentor $mentor ) {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,'.$mentor->users->id.'|max:255',
            'email' => 'required',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'required|max:255',
            'image' => 'image|file|max:2048',
        ];
        
        $validatedData = $request->validate( $rules );
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('profile-photos');
            if($request->password != null){
            $data_user = [
                'id_level' => 2,
                'name'=> $validatedData['name'],
                'username'=> $validatedData['username'],
                'email'=> $validatedData['email'],
                'password'=> bcrypt($validatedData['password']),
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
                'image'=> $validatedData['image'],
            ];
        } else {
            $data_user = [
                'id_level' => 2,
                'name'=> $validatedData['name'],
                'username'=> $validatedData['username'],
                'email'=> $validatedData['email'],
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
                'image'=> $validatedData['image'],
            ];
        }
        }else{
            $data_user = [
                'id_level' => 2,
                'name'=> $validatedData['name'],
                'username'=> $validatedData['username'],
                'email'=> $validatedData['email'],
                'password'=> bcrypt($validatedData['password']),
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
            ];
        }

        $data_mentor = [
            'name'=> $validatedData['name'],
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'address'=> $validatedData['address'],
            'no_hp'=> $validatedData['no_hp'],
        ];
        $mentor->users()->update($data_user);
        $mentor->update($data_mentor);
        // Mentor::where( 'id', $mentor->id )->update( $validatedData );
        return redirect( '/admin/mentor' )->with( 'success', 'Data Berhasil Diupdate!' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Mentor  $mentor
    * @return \Illuminate\Http\Response
    */

    public function destroy( Mentor $mentor ) {
        if ($mentor->users->image) {
            Storage::delete($mentor->users->image);
        }
        Mentor::destroy( $mentor->id );
        return redirect( '/admin/mentor' )->with( 'success', 'Data berhasil dihapus!' );
    }

    public function getMentors(Request $request)
    {
        if ($request->ajax()) {
            $data = Mentor::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name_user', function($data){
                    return $data->users->name ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/mentor/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/mentor/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                </form>
                     <a href="/admin/mentor/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                     
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function export_excel() {
        return Excel::download( new MentorExport, 'mentor.xlsx' );
    }

    public function export_pdf() {
        $mentor = Mentor::get();
        $pdf = PDF::loadView( 'admin.pdf.mentor', ['mentors' => $mentor] )
        ->setPaper('a4', 'landscape');
        // return $pdf->download( 'peserta.pdf' );
        return $pdf->stream();
    }
}