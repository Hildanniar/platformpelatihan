<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\TypeTraining;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CertificateController extends Controller {
    public function getCertificates(Request $request)
    {
        if ($request->ajax()) {
            $data = Certificate::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function($data){
                    return $data->type_trainings->name ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/certificate/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/certificate/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                </form>
                    <a href="/admin/certificate/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function index() {
        return view( 'admin.certificate.index', [ 'certificate' => Certificate::all() ] );
    }


    public function create() {
        return view( 'admin.certificate.create', [ 'type_trainings' => TypeTraining::all() ] );
    }


    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'type_training_id' => 'required',
            'link' => 'required|max:255',
            'desc' => 'required',
        ] );
        Certificate::create( $validatedData );
        return redirect( '/admin/certificate' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }


    public function show( Certificate $certificate ) {
        return view( 'admin.certificate.show', [ 'certificate' => $certificate ] );
    }


    public function edit( Certificate $certificate ) {
        return view( 'admin.certificate.edit', [ 'certificate' => $certificate,  'type_trainings' => TypeTraining::all() ] );
    }

    public function update( Request $request, Certificate $certificate ) {
        $rules = [
            'type_training_id' => 'required',
            'link' => 'required|max:255',
            'desc' => 'required',
        ] ;
        $validatedData = $request->validate( $rules );
        Certificate::where( 'id', $certificate->id )->update( $validatedData );
        return redirect( '/admin/certificate' )->with( 'success', 'Data Berhasil Diupdate!' );
    }


    public function destroy( Certificate $certificate ) {
        Certificate::destroy( $certificate->id );
        return redirect( '/admin/certificate' )->with( 'success', 'Data Berhasil Dihapus!' );
    }

}