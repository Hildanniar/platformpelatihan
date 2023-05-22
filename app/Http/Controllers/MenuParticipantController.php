<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Participant;
use App\Models\TypeTraining;
use App\Models\MateriTask;
use App\Models\Attainment;
use Illuminate\Support\Str;
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
            'attainments' => Attainment::all()
        ]);
    }

    public function show_materi(TypeTraining $materi){
        return view('participants.materi_task.post', [
            'materiTask' => $materi,
        ]);
    }
    
    public function schedule(TypeTraining $schedule){
        return view('participants.schedule.index', [
            'schedule' => $schedule,
        ]);
    }

    public function attainment(TypeTraining $attainments) {
        return view( 'participants.attainment.index', [
            'attainments' => $attainments,
        ] );
    }

    public function CreateAttainments(Request $request){
        $validatedData = $request->validate( [
            'url' => 'required',
            'image'=> 'required|image|file|max:3072',
            'desc' => 'required'
        ]);
        $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->desc ), 200 );
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('hasil-karya');
        }
        $data_attainment = [
            'url'=> $validatedData['url'],
            'image'=> $validatedData['image'],
            'desc'=> $validatedData['desc'],
        ];
        Attainment::create( $data_attainment );
        return redirect( '/participant/attainment' )->with( 'success', 'Hasil Karya berhasil di Upload!' );
    }
}