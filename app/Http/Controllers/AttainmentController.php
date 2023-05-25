<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attainment;
use App\Models\Participant;
use App\Models\TypeTraining;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AttainmentController extends Controller {

    public function index() {
        return view( 'admin.attainment.index', [
            'attainment' => Attainment::all()
        ] );
    }

    public function create() {
        return view( 'admin.attainment.create', [ 
            'type_trainings' => TypeTraining::all(),
            'users' => User::all(),
            'participants' => Participant::all(),
        ]);
    }

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'type_training_id' => 'required',
            'participant_id' => 'required',
            'comment' => 'required',
            'desc' => 'required',
            'image' => 'image|file|max:3000'
        ] );
        if ( $request->file( 'image' ) ) {
            $validatedData[ 'image' ] = $request->file( 'image' )->store( 'hasil-karya' );
        }
        $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->comment ), 200 );
        Attainment::create( $validatedData );
        return redirect( '/admin/attainment' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    public function show( Attainment $attainment ) {
        return view( 'admin.attainment.show', [ 'attainment' => $attainment ] );
    }

    public function edit( Attainment $attainment ) {
        return view( 'admin.attainment.edit', [ 
            'attainment' => $attainment,
            'type_trainings' => TypeTraining::all(),
            'users' => User::all(),
            'participants' => Participant::all(),
            ] );
    }

    public function update( Request $request, Attainment $attainment ) {
        try{
        $rules = [
            'value' => 'required|max:2',
            'status' => 'required|in:NoPublikasi,Publikasi',
        
        ];
        $validatedData = $request->validate( $rules );
        Attainment::where( 'id', $attainment->id )
        ->update( $validatedData );
        return redirect( '/admin/attainment' )->with( 'success', 'Data Berhasil Diedit!' );
        } catch(QueryException $error){
            dd($error);
        }
    }

    public function destroy( Attainment $attainment ) {
        if ( $attainment->image ) {
            Storage::delete( $attainment->image );
        }
        Attainment::destroy( $attainment->id );
        return redirect( '/admin/attainment' )->with( 'success', 'Data Berhasil Dihapus!' );
    }

    public function getAttainment(Request $request)
    {
        if ($request->ajax()) {
            $data = Attainment::all();
            return Datatables::of($data)
                ->addIndexColumn() 
                ->editColumn('name', function($data){
                    return $data->type_trainings->name ?? 'none';
                })
                ->editColumn('name_user', function($data){
                    return $data->participants->name ?? 'none';
                })
                ->editColumn('value', function($data){
                    return $data->value ?? 'Belum dinilai';
                })
            
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/attainment/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/attainment/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                    </form>';
                    
                    return $actionBtn;
                })
            ->rawColumns(['action'])
                
                ->make(true);
        }
    }
}