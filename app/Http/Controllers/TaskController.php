<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TypeTraining;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        return view( 'admin.task.index', [ 'tasks'=> Task::all() ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.task.create', [
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
            'task_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'desc' => 'required'
        ] );
        Task::create( $validatedData );
        return redirect( '/admin/task' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */

    public function show( Task $task ) {
        return view( 'admin.task.show', [
            'tasks' => $task
        ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */

    public function edit( Task $task ) {
        return view( 'admin.task.edit', [
            'tasks' => $task,
            'type_trainings' => TypeTraining::all()
        ] );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Task $task ) {
        $rules = [
            'type_training_id' => 'required',
            'task_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'desc' => 'required'
        ];
        $validatedData = $request->validate( $rules );
        Task::where( 'id', $task->id )
        ->update( $validatedData );
        return redirect( '/admin/task' )->with( 'success', 'Data Berhasil Diupdate' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Task  $task
    * @return \Illuminate\Http\Response
    */

    public function destroy( Task $task ) {
        Task::destroy( $task->id );
        return redirect( '/admin/task' )->with( 'success', 'Data berhasil dihapus!' );
    }

    public function getTasks(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function($data){
                    return $data->type_trainings->name ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/task/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/task/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    <a href="/admin/task/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
