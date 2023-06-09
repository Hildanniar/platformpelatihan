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
    public function getTrainings(Request $request)
    {
        if ($request->ajax()) {
            $data = TypeTraining::all();
            return Datatables::of($data)
                ->addIndexColumn() 
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/type_training/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <a href="/admin/type_training/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function index() {
        return view( 'admin.type_training.index', [
            'type_training' => TypeTraining::all()
        ] );
    }
    
    public function create() {
        return view( 'admin.type_training.create' );
    }

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'name' => 'required|max:255',
            'quota' => 'required|numeric|min:1',
            'desc' => 'required',
            'class' => 'required|in:Offline,Online',
            'image' => 'image|file|max:3000',
        ] );
        if ( $request->file( 'image' ) ) {
            $validatedData[ 'image' ] = $request->file( 'image' )->store( 'post-images' );
        }
        $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->desc ), 200 );
        TypeTraining::create( $validatedData );
        return redirect( '/admin/type_training' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }


    public function show( TypeTraining $typeTraining ) {
        return view( 'admin.type_training.show', [
            'type_training' => $typeTraining
        ] );
    }

    public function edit( TypeTraining $typeTraining ) {
        return view( 'admin.type_training.edit', [
            'type_training' => $typeTraining
        ] );
    }


    public function update( Request $request, TypeTraining $typeTraining ) {
        $rules = [
            'name' => 'required|max:255',
            'quota' => 'required|min:1',
            'desc' => 'required',
            'class' => 'required|in:Offline,Online',
            'image' => 'image|file|max:3000',
        ];
        $validatedData = $request->validate( $rules );

        if ( $request->file( 'image' ) ) {
            if ( $request->oldImage ) {
                Storage::delete( $request->oldImage );
            }
            $validatedData[ 'image' ] = $request->file( 'image' )->store( 'post-images' );
            $validatedData[ 'excerpt' ] = Str::limit( strip_tags( $request->desc ), 200 );
        }
        if($request->image != null){
            $data_type_training = [
                'name'=> $validatedData['name'],
                'quota'=> $validatedData['quota'],
                'desc'=> $validatedData['desc'],
                'class'=> $validatedData['class'],
                'image'=> $validatedData['image'],
            ];
        } else{
            $data_type_training = [
                'name'=> $validatedData['name'],
                'quota'=> $validatedData['quota'],
                'desc'=> $validatedData['desc'],
                'class'=> $validatedData['class'],
            ];
        }
        TypeTraining::where( 'id', $typeTraining->id )
        ->update( $data_type_training );
        return redirect( '/admin/type_training' )->with( 'success', 'Data Berhasil Diedit!' );
    }

    public function destroy( TypeTraining $typeTraining ) {
        if ( $typeTraining->image ) {
            Storage::delete( $typeTraining->image );
        }
        TypeTraining::destroy( $typeTraining->id );
        return redirect( '/admin/type_training' )->with( 'success', 'Data Berhasil Dihapus!' );
    }



    // public function export_excel() {
    //     return Excel::download( new TypeTrainingExport, 'jenis_pelatihan.xlsx' );
    // }

    // public function export_pdf() {
    //     $type_trainings = TypeTraining::get();
    //     $pdf = PDF::loadView( 'admin.pdf.type_training', ['type_trainings' => $type_trainings] )
    //     ->setPaper('a4', 'potrait');
    //     return $pdf->stream();
    // }
}