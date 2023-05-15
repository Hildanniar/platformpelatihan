<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Schedule;
use App\Models\TypeTraining;
use Illuminate\Http\Request;
use App\Exports\ScheduleExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ScheduleController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        return view( 'admin.schedule.index', [
            'schedules' => Schedule::all()
        ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.schedule.create', [
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
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ] );
        Schedule::create( $validatedData );
        return redirect( '/admin/schedule' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Schedule  $schedule
    * @return \Illuminate\Http\Response
    */

    public function show( Schedule $schedule ) {
        return view( 'admin.schedule.show', [
            'schedule' =>  $schedule
        ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Schedule  $schedule
    * @return \Illuminate\Http\Response
    */

    public function edit( Schedule $schedule ) {
        return view( 'admin.schedule.edit', [
            'schedule' => $schedule,
            'type_trainings' => TypeTraining::all()
        ] );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Schedule  $schedule
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Schedule $schedule ) {
        $rules = [
            'type_training_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
        $validatedData = $request->validate( $rules );
        Schedule::where( 'id', $schedule->id )->update( $validatedData );
        return redirect( '/admin/schedule' )->with( 'success', 'Data Berhasil Diupdate!' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Schedule  $schedule
    * @return \Illuminate\Http\Response
    */

    public function destroy( Schedule $schedule ) {
        Schedule::destroy( $schedule->id );
        return redirect( '/admin/schedule' )->with( 'success', 'Data Berhasil Dihapus!' );
    }

    public function getSchedules(Request $request)
    {
        if ($request->ajax()) {
            $data = Schedule::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function($data){
                    return $data->type_trainings->name ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/schedule/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/schedule/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    <a href="/admin/schedule/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function export_excel() {
        return Excel::download( new ScheduleExport, 'jadwal_pelatihan.xlsx' );
    }

    public function export_pdf() {
        $schedule = Schedule::get();
        $pdf = PDF::loadView( 'admin.pdf.schedule', ['schedules' => $schedule] )
        ->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}