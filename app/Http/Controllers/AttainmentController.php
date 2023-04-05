<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attainment;
use App\Models\TypeTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AttainmentController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
        return view( 'admin.attainment.index', [
            'attainment' => Attainment::all()
        ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.attainment.create', [ 
            'type_trainings' => TypeTraining::all(),
            'users' => User::all()
        ]);
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
            'id_user' => 'required',
            'comment' => 'required',
            'desc' => 'required',
            'image' => 'image|file|max:3000'
        ] );
        Attainment::create( $validatedData );
        return redirect( '/admin/attainment' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Attainment  $attainment
    * @return \Illuminate\Http\Response
    */

    public function show( Attainment $attainment ) {
        return view( 'admin.attainment.show', [ 'attainment' => $attainment ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Attainment  $attainment
    * @return \Illuminate\Http\Response
    */

    public function edit( Attainment $attainment ) {
        return view( 'admin.attainment.edit', [ 
            'attainment' => $attainment,
            'type_trainings' => TypeTraining::all(),
            'users' => User::all()
            ] );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Attainment  $attainment
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Attainment $attainment ) {
        $rules = [
            'type_training_id' => 'required',
            'id_user' => 'required',
            'comment' => 'required',
            'desc' => 'required',
            'image' => 'image|file|max:3000'
        ];
        $validatedData = $request->validate( $rules );

        if ( $request->file( 'image' ) ) {
            if ( $request->oldImage ) {
                Storage::delete( $request->oldImage );
            }
            $validatedData[ 'image' ] = $request->file( 'image' )->store( 'post-images' );
            Attainment::where( 'id', $attainment->id )
            ->update( $validatedData );
            return redirect( '/admin/attainment' )->with( 'success', 'Data Berhasil Diedit!' );
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Attainment  $attainment
    * @return \Illuminate\Http\Response
    */

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
                    return $data->users->name ?? 'none';
                })
                ->addColumn('status', function($row){
                    $statusBtn = '
                    <input class="status" type="checkbox" checked data-toggle="toggle" data-id="'.$row->id.'" data-on="Active" data-off="Not Active" data-onstyle="success" data-offstyle="danger">';
                    return $statusBtn;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/attainment/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/attainment/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    <a href="/admin/attainment/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                // ->rawColumns(['publikasi'])
                ->make(true);
        }
    }
}
