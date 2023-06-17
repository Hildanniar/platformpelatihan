<?php

namespace App\Http\Controllers;

use App\Models\MateriTask;
use App\Models\TypeTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MateriTaskController extends Controller {

    public function getMateriTasks(Request $request)
    {
        if ($request->ajax()) {
            $data = MateriTask::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function($data){
                    return $data->type_trainings->name ?? 'none';
                })
                ->editColumn('start_date', function($data){
                    return date('d/m/Y', strtotime($data->start_date)) ?? 'none';
                })
                ->editColumn('end_date', function($data){
                    return date('d/m/Y', strtotime($data->end_date)) ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/materi_tasks/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/materi_tasks/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                </form>
                    <a href="/admin/materi_tasks/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function index() {
        return view( 'admin.materi_tasks.index', [
            'materi_tasks' => MateriTask::all()
        ] );
    }

    public function create() {
        return view( 'admin.materi_tasks.create', [
            'type_trainings' => TypeTraining::all()
        ] );
    }

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'type_training_id' => 'required',
            'name_materi' => 'required',
            'bab_materi' => 'required',
            'file_materi' => 'file|mimes:pdf|max:5000',
            'body_materi' => 'required',
            'name_task' => 'required',
            'criteria_task' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'desc_task' => 'required',
        ] );
        $validatedData[ 'excerpt_materi' ] = Str::limit( strip_tags( $request->body_materi ), 200 );
        if ($request->file('file_materi')) {
            $validatedData['file_materi'] = $request->file('file_materi')->store('file_materi');
        }

        if($request->file_materi != null){
            $data_materi_tasks = [
                'type_training_id'=> $validatedData['type_training_id'],
                'name_materi'=> $validatedData['name_materi'],
                'bab_materi'=> $validatedData['bab_materi'],
                'file_materi'=> $validatedData['file_materi'],
                'body_materi'=> $validatedData['body_materi'],
                'name_task'=> $validatedData['name_task'],
                'criteria_task'=> $validatedData['criteria_task'],
                'start_date'=> $validatedData['start_date'],
                'end_date'=> $validatedData['end_date'],
                'desc_task'=> $validatedData['desc_task'],
                'excerpt_materi'=> $validatedData['excerpt_materi'],
            ];
        } else {
            $data_materi_tasks = [
                'type_training_id'=> $validatedData['type_training_id'],
                'name_materi'=> $validatedData['name_materi'],
                'bab_materi'=> $validatedData['bab_materi'],
                'body_materi'=> $validatedData['body_materi'],
                'name_task'=> $validatedData['name_task'],
                'criteria_task'=> $validatedData['criteria_task'],
                'start_date'=> $validatedData['start_date'],
                'end_date'=> $validatedData['end_date'],
                'desc_task'=> $validatedData['desc_task'],
                'excerpt_materi'=> $validatedData['excerpt_materi'],
            ];
        }
        MateriTask::create( $data_materi_tasks );
        return redirect( '/admin/materi_tasks' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    public function show( MateriTask $materiTask ) {
        return view( 'admin.materi_tasks.show', [
            'materi_tasks' => $materiTask,
        ]);
    }

    public function edit( MateriTask $materiTask ) {
        return view( 'admin.materi_tasks.edit', [
            'materi_tasks' => $materiTask,
            'type_trainings' => TypeTraining::all()
        ] );
    }

    public function update( Request $request, MateriTask $materiTask ) {
        $rules = [
            'type_training_id' => 'required',
            'name_materi' => 'required',
            'bab_materi' => 'required',
            'file_materi' => 'file|mimes:pdf|max:5120',
            'body_materi' => 'required',
            'name_task' => 'required',
            'criteria_task' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'desc_task' => 'required',
        ];
        $validatedData = $request->validate( $rules );

        if ( $request->file( 'file_materi' ) ) {
            if ( $request->oldFile ) {
                Storage::delete( $request->oldFile );
            }
            $validatedData[ 'file_materi' ] = $request->file( 'file_materi' )->store( 'file_materi' );
        }
        $validatedData[ 'excerpt_materi' ] = Str::limit( strip_tags( $request->body_materi ), 200 );
        MateriTask::where( 'id', $materiTask->id )
        ->update( $validatedData );
        return redirect( '/admin/materi_tasks' )->with( 'success', 'Data Berhasil Diupdate' );
    }

    public function destroy( MateriTask $materiTask ) {
        if ( $materiTask->file_materi ) {
            Storage::delete( $materiTask->file_materi );
        }
        MateriTask::destroy( $materiTask->id );
        return redirect( '/admin/materi_tasks' )->with( 'success', 'Data Berhasil dihapus!' );
    }

}