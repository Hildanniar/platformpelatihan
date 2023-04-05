<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TypeTraining;
use App\Exports\TypeTrainingExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TypeTrainingController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        return view( 'admin.type_training.index', [
            'type_training' => TypeTraining::all()
        ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.type_training.create' );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'name' => 'required|max:255',
            'quota' => 'required|min:1',
            'desc' => 'required',
            'image' => 'image|file|max:3000'
        ] );
        if ( $request->file( 'image' ) ) {
            $validatedData[ 'image' ] = $request->file( 'image' )->store( 'post-images' );
        }
        $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->desc ), 200 );
        TypeTraining::create( $validatedData );
        return redirect( '/admin/type_training' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\TypeTraining  $typeTraining
    * @return \Illuminate\Http\Response
    */

    public function show( TypeTraining $typeTraining ) {
        return view( 'admin.type_training.show', [
            'type_training' => $typeTraining
        ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\TypeTraining  $typeTraining
    * @return \Illuminate\Http\Response
    */

    public function edit( TypeTraining $typeTraining ) {
        return view( 'admin.type_training.edit', [
            'type_training' => $typeTraining
        ] );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\TypeTraining  $typeTraining
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, TypeTraining $typeTraining ) {
        $rules = [
            'name' => 'required|max:255',
            'quota' => 'required|min:1',
            'desc' => 'required',
            'image' => 'image|file|max:3000'
        ];
        $validatedData = $request->validate( $rules );

        if ( $request->file( 'image' ) ) {
            if ( $request->oldImage ) {
                Storage::delete( $request->oldImage );
            }
            $validatedData[ 'image' ] = $request->file( 'image' )->store( 'post-images' );
            $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->body ), 200 );

            TypeTraining::where( 'id', $typeTraining->id )
            ->update( $validatedData );
            return redirect( '/admin/type_training' )->with( 'success', 'Data Berhasil Diedit!' );
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\TypeTraining  $typeTraining
    * @return \Illuminate\Http\Response
    */

    public function destroy( TypeTraining $typeTraining ) {
        if ( $typeTraining->image ) {
            Storage::delete( $typeTraining->image );
        }
        TypeTraining::destroy( $typeTraining->id );
        return redirect( '/admin/type_training' )->with( 'success', 'Data Berhasil Dihapus!' );
    }

    public function getTrainings(Request $request)
    {
        if ($request->ajax()) {
            $data = TypeTraining::all();
            return Datatables::of($data)
                ->addIndexColumn() 
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/type_training/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/type_training/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    <a href="/admin/type_training/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function export_excel() {
        return Excel::download( new TypeTrainingExport, 'jenis_pelatihan.xlsx' );
    }

    public function export_pdf() {
        $type_trainings = TypeTraining::get();
        $pdf = PDF::loadView( 'admin.pdf.type_training', ['type_trainings' => $type_trainings] )
        ->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
