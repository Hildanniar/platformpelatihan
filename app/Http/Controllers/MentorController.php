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
use Illuminate\Database\QueryException;

class MentorController extends Controller {

    public function index() {
        return view( 'admin.mentor.index');

    }

    public function create() {
        return view( 'admin.mentor.create');
    }

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
        }
        $data_user = [
            'level_id' => 2,
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'password'=> bcrypt($validatedData['password']),
        ];
        $user = User::create( $data_user );
        $user_last_id = $user->id;
        if($request->image != null){
            $data_mentor = [
                'user_id' => $user_last_id,
                'name'=> $validatedData['name'],
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
                'image'=> $validatedData['image'],
            ];
        } else {
            $data_mentor = [
                'user_id' => $user_last_id,
                'name'=> $validatedData['name'],
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
            ];
        }
        Mentor::create( $data_mentor );
        return redirect( '/admin/mentor' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    public function show( Mentor $mentor ) {
        return view( 'admin.mentor.show', [
            'mentor' => $mentor,
        ] );
    }

    public function edit( Mentor $mentor ) {
        return view( 'admin.mentor.edit', [
            'mentor' => $mentor,
            'users' => User::all(),
        ] );
    }

    public function update( Request $request, Mentor $mentor ) {
        try{
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,'.$mentor->users->id.'|max:255',
            'email' => 'required',
            'password'=>'nullable',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'required|max:255',
            'image' => 'image|file|max:2048',
        ];
        
        $validatedData = $request->validate( $rules );
            $data_user = [
                'username'=> $validatedData['username'],
                'email'=> $validatedData['email'],
                'password'=> bcrypt($validatedData['password']),
                
            ];
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('profile-photos');
        }
        if($request->image != null){
        $data_mentor = [
            'name'=> $validatedData['name'],
            'address'=> $validatedData['address'],
            'age'=> $validatedData['age'],
            'no_hp'=> $validatedData['no_hp'],
            'gender'=> $validatedData['gender'],
            'profession'=> $validatedData['profession'],
            'no_member'=> $validatedData['no_member'],
            'image'=> $validatedData['image'],
            
        ];
    } else{
        $data_mentor = [
            'name'=> $validatedData['name'],
            'address'=> $validatedData['address'],
            'age'=> $validatedData['age'],
            'no_hp'=> $validatedData['no_hp'],
            'gender'=> $validatedData['gender'],
            'profession'=> $validatedData['profession'],
            'no_member'=> $validatedData['no_member'],
            
        ];
    }
        $mentor->users()->update($data_user);
        $mentor->update($data_mentor);
        return redirect( '/admin/mentor' )->with( 'success', 'Data Berhasil Diupdate!' );
    } catch(QueryException $error){
        dd($error);
    }
    }

    public function destroy( Mentor $mentor ) {
        if ($mentor->users->image) {
            Storage::delete($mentor->users->image);
        }
        $mentor->users()->delete();
        $mentor->destroy($mentor->id);
        return redirect( '/admin/mentor' )->with( 'success', 'Data berhasil dihapus!' );
    }

    public function getMentors(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereRelation('levels', 'name', 'Mentor')->get(); 
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function($data){
                    return $data->mentors->name ?? 'none';
                })
                ->editColumn('address', function($data){
                    return $data->mentors->address ?? 'none';
                })
                ->editColumn('no_hp', function($data){
                    return $data->mentors->no_hp ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/mentor/'. $row->mentors->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/mentor/'. $row->mentors->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                </form>
                    <a href="/admin/mentor/'. $row->mentors->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                
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