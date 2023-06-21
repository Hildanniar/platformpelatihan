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

    public function getParticipants(Request $request)
    {
        if ($request->ajax()) {
            $data = Participant::all();
            return Datatables::of($data)
            ->addIndexColumn()
                ->editColumn('name_user', function($data){
                    return $data->name ?? 'none';
                })
                ->editColumn('address', function($data){
                    return $data->address ?? 'none';
                })
                ->editColumn('no_hp', function($data){
                    return $data->no_hp ?? 'none';
                })
                ->editColumn('email', function($data){
                    return $data->users->email ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/participant/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/participant/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    <a href="/admin/participant/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function index() {
        return view( 'admin.participant.index', [
            'participants' => Participant::all()
        ] );
    }


    public function create() {
        return view( 'admin.participant.create',[
            'users' => User::all(),
            'type_trainings' => TypeTraining::all()
        ] );
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
            'no_member' => 'max:255',
            'image' => 'image|file|max:2048',
            
        ] );

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-photos');
        }
        $data_user = [
            'level_id' => 3,
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'password'=> bcrypt($validatedData['password']),
            'is_active' => '1',
        ];
        $user = User::create( $data_user );
        $user_last_id = $user->id;
        if($request->image != null){
        $data_participant = [
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
        $data_participant = [
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
        Participant::create( $data_participant );
        return redirect( '/admin/participant' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    public function show( Participant $participant ) {
        return view( 'admin.participant.show', [
            'participant' => $participant,
        ] );
        }
        
    public function edit( Participant $participant ) {
        return view( 'admin.participant.edit', [
            'participant' => $participant,
            'users' => User::all(),
            'type_trainings' => TypeTraining::all()
        ] );
    }

    public function update( Request $request, Participant $participant ) {
        try{
        $rules =  [
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,'.$participant->users->id.'|max:255',
            'email' => 'required',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'max:255',
            'image' => 'image|file|max:2048',
        ] ;
        if($request->password != null){
            $rules['password'] = 'max:20';
        }
        $validatedData = $request->validate( $rules );
        if($request->password != null){
            $data_user = [
                'level_id' => 3,
                'username'=> $validatedData['username'],
                'email'=> $validatedData['email'],
                'password'=> bcrypt($validatedData['password']),
                
            ];
        } else {
            $data_user = [
                'level_id' => 3,
                'username'=> $validatedData['username'],
                'email'=> $validatedData['email'],
            ];
        }
        
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('profile-photos');
        }
        if($request->image != null){
        $data_participant = [
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
        $data_participant = [
            'name'=> $validatedData['name'],
            'address'=> $validatedData['address'],
            'age'=> $validatedData['age'],
            'no_hp'=> $validatedData['no_hp'],
            'gender'=> $validatedData['gender'],
            'profession'=> $validatedData['profession'],
            'no_member'=> $validatedData['no_member'],
        ];
    }
        $participant->users()->update($data_user);
        $participant->update($data_participant);
        return redirect( '/admin/participant' )->with( 'success', 'Data Berhasil Diupdate!' );
    } catch(QueryException $error){
        dd($error);
    }
}

    public function destroy( Participant $participant ) {
        if ($participant->image) {
            Storage::delete($participant->image);
        }
        $participant->users()->delete();
        $participant->destroy($participant->id);
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
        return $pdf->stream();
    }

}