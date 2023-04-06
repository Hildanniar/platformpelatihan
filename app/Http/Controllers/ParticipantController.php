<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\TypeTraining;
use App\Exports\ParticipantExport;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ParticipantController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        return view( 'admin.participant.index', [
            'participants' => Participant::all()
        ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.participant.create',[
            'users' => User::all(),
            'type_trainings' => TypeTraining::all()
        ] );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'type_training_id' => 'required',
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
            'image' => 'image|file|max:2048'
        ] );
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-photos');

        $data_user = [
            'id_level' => 3,
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
            'id_level' => 3,
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
        $data_participant = [
            'type_training_id'=> $validatedData['type_training_id'],
            'id_user' => $user_last_id,
            'name'=> $validatedData['name'],
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'address'=> $validatedData['address'],
            'no_hp'=> $validatedData['no_hp'],
        ];
        Participant::create( $data_participant );
        return redirect( '/admin/participant' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Participant  $participant
    * @return \Illuminate\Http\Response
    */

    public function show( Participant $participant ) {
        return view( 'admin.participant.show', [
            'participant' => $participant,
        ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Participant  $participant
    * @return \Illuminate\Http\Response
    */

    public function edit( Participant $participant ) {
        // dd($participant->users);
        return view( 'admin.participant.edit', [
            'participant' => $participant,
            'users' => User::all(),
            'type_trainings' => TypeTraining::all()
        ] );
    }

    public function update( Request $request, Participant $participant ) {
        // dd($request);
        try{
        $rules =  [
            'type_training_id' => 'required',
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,'.$participant->users->id.'|max:255',
            'email' => 'required',
            // 'password' => 'required',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'required|max:255',
            'image' => 'image|file|max:2048',
            'class' => 'required|in:Offline,Online'
        ] ;
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
        $data_participant = [
            'type_training_id'=> $validatedData['type_training_id'],
            'name'=> $validatedData['name'],
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'address'=> $validatedData['address'],
            'no_hp'=> $validatedData['no_hp'],
        ];
        $participant->users()->update($data_user);
        $participant->update($data_participant);
        return redirect( '/admin/participant' )->with( 'success', 'Data Berhasil Diupdate!' );
    } catch(QueryException $error){
        dd($error);
    }
}

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Participant  $participant
    * @return \Illuminate\Http\Response
    */

    public function destroy( Participant $participant ) {
        if ($participant->users->image) {
            Storage::delete($participant->users->image);
        }
        Participant::destroy( $participant->id );
        return redirect( '/admin/participant' )->with( 'success', 'Data berhasil Dihapus!' );
    }

    public function export_excel() {
        return Excel::download( new ParticipantExport, 'peserta.xlsx' );
    }

    public function export_pdf() {
        $participant = Participant::get();
        $pdf = PDF::loadView( 'admin.pdf.participant', [
            'participants' => $participant
        ] )
        ->setPaper('a4', 'landscape');
        // return $pdf->download( 'peserta.pdf' );
        return $pdf->stream();
    }

    public function getParticipants(Request $request)
    {
        if ($request->ajax()) {
            $data = Participant::all();
            return Datatables::of($data)
                ->addIndexColumn() ->editColumn('name_user', function($data){
                    return $data->users->name ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/participant/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/participant/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    <a href="/admin/participant/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}
