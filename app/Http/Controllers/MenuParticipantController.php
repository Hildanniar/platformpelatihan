<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Participant;
use App\Models\TypeTraining;
use App\Models\MateriTask;
use App\Models\Attainment;
use App\Models\Certificate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

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
                    <a href="/participant/schedule/'. $row->id .'" class="edit btn btn-primary btn-sm text-white"><i class="far fa-clock""></i> Jadwal</a>';
                    return $actionBtn;
                })
                ->addColumn('materi', function($row){
                    if($row->class =='Online' ){
                    $materiBtn = '
                    <a href="/participant/materi_task/'. $row->id .'" class="btn btn-danger btn-sm"><i class="far fa-file"></i> Materi</a>';
                    return $materiBtn;
                    }else{
                        $materiBtn = '
                        <a href="/participant/information/'. $row->id .'" class="btn btn-warning btn-sm"><i class="far fa-file"></i> Materi</a>';
                    return $materiBtn;
                    }
                
                })
                ->addColumn('certificate', function($row){
                    $certificateBtn = '
                    <a href="/participant/certificate/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-file"></i> Sertifikat</a>';
                    return $certificateBtn;
                })
                ->addColumn('comment', function($row){
                    $commentBtn = '
                    <a href="/participant/comment/'. $row->id .'" class="btn btn-info btn-sm text-white"><i class="far fa-file"></i> Komentar</a>';
                    return $commentBtn;
                })
                // ->addColumn('comment', function($row){
                //     $commentBtn = '
                //     <button type="button" value='. $row->id .' class="btn btn-info editbtn btn-sm text-white"><i class="far fa-file"></i> Komentar</button>';
                //     return $commentBtn;
                // })
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
        $attainments = Attainment::where('participant_id', auth()->user()->id)->where('materi_task_id', $materi->id)->first();
        return view('participants.materi_task.post', [
            'materiTask' => $materi,
            'attainments' => $attainments
        ]);
    }
    
    public function download_materi(){
        try {
        return Storage::disk('local')->download('public/file_materi/COIOrbxq6cGp8ucuwG2Mo7zsqi9YCdf7RIK4e8AS.pdf');
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function schedule(TypeTraining $typeTraining){
        // dd($typeTraining);
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
            'type_training_id' => $participant->type_training_id,
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
        $data_attainment = [
            'link'=> $validatedData['link'],
            'image'=> $validatedData['image'],
            'desc'=> $validatedData['desc'],
            'excerpt'=> $validatedData['excerpt'],
            'type_training_id' => $typeTraining->id,
            'participant_id'=> $participant->id,
            'materi_task_id'=> $validatedData['materi_task_id'],
            'is_active' => '1',
        ];
        Attainment::create( $data_attainment );
        return redirect( '/participant/attainment' )->with( 'success', 'Hasil Karya berhasil di Upload!' );
    }
    
    public function comment(TypeTraining $typeTraining){
        return view('participants.comment.create', [
        'typeTraining' => $typeTraining
        ]);
    }

    public function create_comment( TypeTraining $typeTraining, Request $request){
        $validatedData = $request->validate( [
            'comment' => 'required'
        ]);
        $participant = Participant::where('user_id', auth()->user()->id)->first();
        $data_participant = [
            'type_training_id'=> $typeTraining->id,
            'name'=> $participant->name,
            'address'=> $participant->address,
            'age'=> $participant->age,
            'no_hp'=> $participant->no_hp,
            'gender'=>$participant->gender,
            'profession'=> $participant->profession,
            'no_member'=>$participant->no_member,
            'comment'=> $validatedData['comment'],
            'image'=> $participant->image,
            'status'=> $participant->status,
            'is_active'=> $participant->is_active,
        ];
        $participant->update($data_participant);
        return redirect( '/participant/training' )->with( 'success', 'Berhasil Memberi Komentar!' );
    }

}