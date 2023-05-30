<?php

namespace App\Http\Controllers;
use App\Models\TypeTraining;
use App\Models\Participant;
use App\Models\TrainingParticipants;
use App\Models\User;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingParticipantsController extends Controller {

    public function getTrainingParticipants(Request $request)
    {
        if ($request->ajax()) {
            $data = TrainingParticipants::all();
            return Datatables::of($data)
                ->addIndexColumn() 
                ->editColumn('name', function($data){
                    return $data->type_trainings->name ?? 'none';
                })
                ->editColumn('name_user', function($data){
                    return $data->participants->name ?? 'none';
                })
                ->editColumn('value', function($data){
                    return $data->status;
                })
            
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/training_participants/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>';
                    
                    return $actionBtn;
                })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    public function index() {
        return view( 'admin.training_participants.index', [
            'training_participants' => TrainingParticipants::all()
        ] );
    }


    public function create() {
        //
    }

    public function store( Request $request ) {
        //
    }


    public function show( $id ) {
        //
    }


    public function edit(TrainingParticipants  $training_participant ) {
        return view( 'admin.training_participants.edit', [ 
            'training_participants' => $training_participant,
            'type_trainings' => TypeTraining::all(),
            'participants' => Participant::all(),
            ] );
    }


    public function update( Request $request, TrainingParticipants  $training_participant ) {
        try{
            $rules = [
                'status' => 'in:NoPublikasi,Publikasi',
            
            ];
            $validatedData = $request->validate( $rules );
            TrainingParticipants::where( 'id', $training_participant->id )
            ->update( $validatedData );
            return redirect( '/admin/training_participants' )->with( 'success', 'Komentar Berhasil di Publikasi!' );
            } catch(QueryException $error){
                dd($error);
            }
    }


    public function destroy( $id ) {
        //
    }

    public function regristration( TypeTraining $type_training ) {
        return view( 'dashboard.layouts.participants.RegristrationTraining', [
            'type_training' => $type_training,
        ] );
    }

    public function AddRegristration( TypeTraining $typeTraining, Request $request ) {
        $rules =  [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'max:255',

        ] ;
        $participant = Participant::where( 'user_id', auth()->user()->id )->first();
        $validatedData = $request->validate( $rules );
        $user = User::find( Auth::user()->id );
        if ( $user ) {
            $data_participant = [
                'user_id'=> $user->id,
                'name'=> $validatedData[ 'name' ],
                'address'=> $validatedData[ 'address' ],
                'age'=> $validatedData[ 'age' ],
                'no_hp'=> $validatedData[ 'no_hp' ],
                'gender'=> $validatedData[ 'gender' ],
                'profession'=> $validatedData[ 'profession' ],
                'no_member'=> $validatedData[ 'no_member' ],
                'image'=> null,
                'is_active' => '1'
            ];

            $data_training_participants = [
                'participant_id'=> $participant->id,
                'type_training_id' => $typeTraining->id,
                'comment' => null,
                'status' => 'NoPublikasi',
                'is_active' => '1'
            ];
            $user->participants()->update( $data_participant );
            TrainingParticipants::create( $data_training_participants );
            return Redirect()->back()->with( 'success', 'Anda Berhasil Mendaftar!!!' );
        }
        return Redirect()->back();
    }

    public function comment( TypeTraining $typeTraining ) {
        return view( 'participants.comment.create', [
            'typeTraining' => $typeTraining
        ] );
    }

    public function create_comment( TypeTraining $typeTraining, Request $request ) {
        $validatedData = $request->validate( [
            'comment' => 'required'
        ] );
        $participant = Participant::where( 'user_id', auth()->user()->id )->first();
        $trainingParticipants = TrainingParticipants::where( 'type_training_id', $typeTraining->id )->first();
        $data_training_participants = [
            'participant_id'=> $participant->id,
            'type_training_id'=> $trainingParticipants->type_training_id,
            'comment'=> $validatedData[ 'comment' ],
            'status'=> 'NoPublikasi',
            'is_active'=> '1',
        ];
        // dd( $trainingParticipants );
        $trainingParticipants->update( $data_training_participants );
        return redirect( '/participant/training' )->with( 'success', 'Berhasil Memberi Komentar!' );
    }
}