<?php

namespace App\Http\Controllers;

use App\Models\MateriTask;
use App\Models\TypeTraining;
use Illuminate\Http\Request;

class MateriTaskController extends Controller {
    public function index() {
        return view( 'admin.materi_tasks.index', [
            'materi_tasks' => MateriTask::all()
        ] );
    }

    public function create() {
        //
    }

    public function store( Request $request ) {
        //
    }

    public function show( MateriTask $materiTask ) {
        //
    }

    public function edit( MateriTask $materiTask ) {
        //
    }

    public function update( Request $request, MateriTask $materiTask ) {
        //
    }

    public function destroy( MateriTask $materiTask ) {
        //
    }
}
