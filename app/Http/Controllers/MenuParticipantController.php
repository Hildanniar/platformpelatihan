<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Participant;
use App\Models\TypeTraining;

class MenuParticipantController extends Controller {

    public function getTraining(Request $request) {
        
        if ($request->ajax()) {
            $data = TypeTraining::whereRelation('participants', 'user_id', auth()->user()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('type_training_id', function($data){
                    return $data->name ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/participant/schedule/'. $row->id .'" class="edit btn btn-primary btn-sm"><i class="far fa-clock""></i> Jadwal</a>
                    <a href="/participant/materi_task/'. $row->id .'" class="btn btn-danger btn-sm"><i class="far fa-file"></i> Materi</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function training() {
        return view( 'participants.training.index', [
            'participants' => Participant::all()
        ] );
    }

    public function materi_task(TypeTraining $materiTask ){
        return view('participants.materi_task.index', [
            'materiTask' => $materiTask,
        ]);
    }
    
    public function schedule(TypeTraining $typeTraining){
        return view('participants.schedule.index', [
            'typeTraining' => $typeTraining,
        ]);
    }

    public function attainment() {
        return view( 'participants.attainment.index' );
    }
}