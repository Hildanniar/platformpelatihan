<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Participant;
use TypeTraining;

class MenuParticipantController extends Controller {

    public function training() {
        return view( 'participants.training.index', [
            'participants' => Participant::all()
        ] );
    }

    public function getTraining(Request $request) {
        if ($request->ajax()) {
            $data = Participant::all();
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

    public function attainment() {
        return view( 'participants.attainment.index' );
    }
}