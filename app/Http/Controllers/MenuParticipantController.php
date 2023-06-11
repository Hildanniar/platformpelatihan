<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\Attainment;
use App\Models\MateriTask;
use App\Models\Participant;
use Illuminate\Support\Str;
use App\Models\TypeTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Models\TrainingParticipants;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuParticipantController extends Controller {

    public function getTraining(Request $request) {
        
        if ($request->ajax()) {
            $data = TrainingParticipants::whereRelation('participants', 'user_id', auth()->user()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('type_training_id', function($data){
                    return $data->type_trainings->name ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/participant/schedule/'. $row->type_trainings->id .'" class="edit btn btn-primary btn-sm text-white"><i class="far fa-clock""></i> Jadwal</a>';
                    return $actionBtn;
                })
                ->addColumn('materi', function($row){
                    if($row->type_trainings->class =='Online' ){
                    $materiBtn = '
                    <a href="/participant/materi_task/'. $row->type_trainings->id .'" class="btn btn-danger btn-sm"><i class="far fa-file"></i> Materi</a>';
                    return $materiBtn;
                    }else{
                        $materiBtn = '
                        <a href="/participant/information/'. $row->type_trainings->id .'" class="btn btn-warning btn-sm"><i class="far fa-file"></i> Materi</a>';
                    return $materiBtn;
                    }
                })
                ->addColumn('certificate', function($row){
                    if($row->type_trainings->certificates){
                    $certificateBtn = '
                    <a href="/participant/certificate/'. $row->type_trainings->id .'" class="btn btn-success btn-sm"><i class="far fa-file"></i> Sertifikat</a>';
                    return $certificateBtn;
                }else{
                    $certificateBtn = '
                    <button class="btn btn-success btn-sm text-white">Sertifikat belum diupload</button>';
                    return $certificateBtn;
                }
                })
                ->addColumn('comment', function($row){
                    if($row->comment == null){
                    $commentBtn = '
                    <a href="/participant/comment/'. $row->type_trainings->id .'" class="btn btn-info btn-sm text-white"><i class="far fa-file"></i> Komentar</a>';
                    return $commentBtn;
                }else{
                    $certificateBtn = '
                    <button class="btn btn-info btn-sm text-white">Sudah memberi komentar</button>';
                    return $certificateBtn;
                }
                })
                ->rawColumns(['action', 'materi', 'certificate', 'comment'])
                ->make(true);
        }
    }

    public function training() {
        return view( 'participants.training.index', [
            'participants' => Participant::all()
        ] );
    }

    public function materi_task_online(TypeTraining $type_training ){
        $materi_tasks = MateriTask::where('type_training_id', $type_training->id )->orderBy('bab_materi')->with('attainments')->get();
        // $attainments = Attainment::where('participant_id', auth()->user()->participants->id)->where('materi_task_id', $materi_tasks->id)->first();
        // dd($materi_tasks);
        return view('participants.materi_task.class_online', [
            'materiTask' => $materi_tasks,
        ]);
    }
    public function materi_task_offline(TypeTraining $typeTraining ){
        // $materi_tasks = MateriTask::where('type_training_id', $typeTraining->id )->get();
        return view('participants.materi_task.class_offline', [
            'typeTraining' => $typeTraining,
            // 'attainments' => Attainment::all()
        ]);
    }

    public function show_materi(MateriTask $materi){
        $attainments = Attainment::where('participant_id', auth()->user()->participants->id)->where('materi_task_id', $materi->id)->first();
        $todayDate = Carbon::now()->format('Y-m-d');
        return view('participants.materi_task.post', [
            'materiTask' => $materi,
            'attainments' => $attainments,
            'today' => $todayDate
        ]);
    }
    
    public function download_materi(MateriTask $materi){
    // dd($materi);
        try {
        return Response::download('storage/'.$materi->file_materi, $materi->bab_materi.'-'.$materi->name_materi.'.pdf');
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function schedule(TypeTraining $typeTraining){
        return view('participants.schedule.index', [
            'typeTraining' => $typeTraining,
        ]);
    }

    public function certificate(TypeTraining $typeTraining){
        // dd($typeTraining->certificates);
        return view('participants.certificate.index', [
            'typeTraining' => $typeTraining,
        ]);
    }

    public function attainment(){
        $participant = Participant::where('user_id', auth()->user()->id)->first();
        $attainment = Attainment::where('participant_id', $participant->id)->latest()->paginate(6);
        return view( 'participants.attainment.index', [
            'attainment' => $attainment,
        ]);
    }

    public function show_attainment( Attainment $attainment ) {
        // dd( $attainment->users );
        return view( 'participants.attainment.show_attainment', [
            'attainment' => $attainment,
        ] );
    }
    

    public function UploadAttainmentOnline(MateriTask $materiTask) {
        return view( 'participants.attainment.upload_attainment_online', [
            'materiTask' => $materiTask,
        ] );
    }

    public function CreateAttainmentOnline(MateriTask $materiTask, Request $request){
        $validatedData = $request->validate( [
            'link' => 'required',
            'image'=> 'required|image|file|max:3072',
            'desc' => 'required'
        ]);
        $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->desc ), 200 );
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('hasil-karya');
        }
        $participant = Participant::where('user_id', auth()->user()->id)->first();
        $data_attainment = [
            'link'=> $validatedData['link'],
            'image'=> $validatedData['image'],
            'desc'=> $validatedData['desc'],
            'excerpt'=> $validatedData['excerpt'],
            'type_training_id' => $materiTask->type_training_id,
            'participant_id'=> $participant->id,
            'materi_task_id'=> $materiTask->id,
            'is_active' => '1',
        ];
        
        Attainment::create( $data_attainment );
        return redirect( '/participant/attainment' )->with( 'success', 'Hasil Karya berhasil di Upload!' );
    }
    public function UploadAttainmentOffline(TypeTraining $typeTraining) {
        return view( 'participants.attainment.upload_attainment_offline', [
            'typeTraining' => $typeTraining,
            'materi_tasks' => MateriTask::all() 
        ] );
    }

    public function CreateAttainmentOffline(TypeTraining $typeTraining, Request $request){
        $validatedData = $request->validate( [
            'materi_task_id'=> 'required',
            'link' => 'required',
            'image'=> 'required|image|file|max:3072',
            'desc' => 'required'
        ]);
        $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->desc ), 200 );
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('hasil-karya');
        }
        $participant = Participant::where('user_id', auth()->user()->id)->first();
        $trainingParticipants = TrainingParticipants::where( 'type_training_id', $typeTraining->id )->first();
        $data_attainment = [
            'link'=> $validatedData['link'],
            'image'=> $validatedData['image'],
            'desc'=> $validatedData['desc'],
            'excerpt'=> $validatedData['excerpt'],
            'type_training_id' => $trainingParticipants->type_training_id,
            'participant_id'=> $participant->id,
            'materi_task_id'=> $validatedData['materi_task_id'],
            'is_active' => '1',
        ];
        Attainment::create( $data_attainment );
        return redirect( '/participant/attainment' )->with( 'success', 'Hasil Karya berhasil di Upload!' );
    }
    

}