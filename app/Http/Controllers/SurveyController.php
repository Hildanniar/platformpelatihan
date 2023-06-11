<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SurveyController extends Controller {
    public function getSurveys(Request $request)
    {
        if ($request->ajax()) {
            $data = Survey::all();
            return Datatables::of($data)
                ->addIndexColumn() 
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <form action="/admin/survey/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    <a href="/admin/survey/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function index() {
        return view( 'admin.survey.index', [ 'surveys' => Survey::all() ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    // public function create() {
    //     return view( 'dashboard.layouts.main', [
    //         'surveys' => Survey::all()
    //     ] );
    // }


    // public function store( Request $request ) {
    //     $validatedData = $request->validate( [
    //         'name' => 'required',
    //         'age' => 'required',
    //         'city' => 'required',
    //         'profession' => 'required',
    //         'type_training' => 'required',
    //         'month' => 'required',
    //         'excuse' => 'required'
    //     ] );
    //     Survey::create( $validatedData );
    //     return redirect( '/' )->with( 'success', 'Berhasil Dikirim!' );
    // }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Survey  $survey
    * @return \Illuminate\Http\Response
    */

    public function show( Survey $survey ) {
        return view( 'admin.survey.show', [
            'surveys' => $survey
        ] );
    }

    // public function edit( Survey $survey ) {
    
    // }


    // public function update( Request $request, Survey $survey ) {
    // }


    public function destroy( Survey $survey ) {
        Survey::destroy( $survey->id );
        return redirect( '/admin/survey' )->with( 'success', 'Data Berhasil Dihapus!' );
    }


}