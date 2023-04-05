<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\TypeTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        return view( 'admin.materi.index', [
            'materials' => Material::all(),
        ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.materi.create', [
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
            'file_materi' => 'file|mimes:pdf|max:5120|required',
            'body' => 'required'
        ] );
        $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->body ), 200 );
        $validatedData[ 'file_materi' ] = $request->file( 'file_materi' )->store( 'file_materi' );
        Material::create( $validatedData );
        return redirect( '/admin/materi' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Material  $material
    * @return \Illuminate\Http\Response
    */

    public function show( Material $materi ) {
        return view( 'admin.materi.show', [
            'materi' => $materi,

        ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Material  $material
    * @return \Illuminate\Http\Response
    */

    public function edit( Material $materi ) {
        return view( 'admin.materi.edit', [
            'materi' => $materi,
            'type_trainings' => TypeTraining::all()
        ] );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Material  $material
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Material $materi ) {
        $rules = [
            'type_training_id' => 'required',
            'file_materi' => 'file|pdf|5000',
            'body' => 'required'
        ];
        $validatedData = $request->validate( $rules );

        if ( $request->file( 'file_materi' ) ) {
            if ( $request->oldfile_materi ) {
                Storage::delete( $request->oldFile );
            }
            $validatedData[ 'file_materi' ] = $request->file( 'file_materi' )->store( 'post-file_materi' );
        }
        $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->body ), 200 );
        Material::where( 'id', $materi->id )
        ->update( $validatedData );
        return redirect( '/admin/materi' )->with( 'success', 'Data Berhasil Diupdate' );

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Material  $material
    * @return \Illuminate\Http\Response
    */

    public function destroy( Material $materi ) {
        if ( $materi->file_materi ) {
            Storage::delete( $materi->file_materi );
        }
        Material::destroy( $materi->id );
        return redirect( '/admin/materi' )->with( 'success', 'Data Berhasil dihapus!' );
    }

      public function getMateri(Request $request)
    {
        if ($request->ajax()) {
            $data = Material::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function($data){
                    return $data->type_trainings->name ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/materi/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/materi/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                </form>
                     <a href="/admin/materi/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                     
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
