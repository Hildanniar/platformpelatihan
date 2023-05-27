<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller {

    public function getAdmins(Request $request)
    {
        if ($request->ajax()) {
            $data = Admin::all();
            return Datatables::of($data)
            ->addIndexColumn()
                ->editColumn('name_user', function($data){
                    return $data->name ?? 'none';
                })
                ->editColumn('address', function($data){
                    return $data->address ?? 'none';
                })
                ->editColumn('no_hp', function($data){
                    return $data->no_hp ?? 'none';
                })
                ->editColumn('email', function($data){
                    return $data->users->email ?? 'none';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <a href="/admin/admin/'. $row->id .'/edit" class="edit btn btn-warning btn-sm"><i class="far fa-edit""></i> Edit</a>
                    <form action="/admin/admin/'. $row->id .'" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm" onclick="return confirm("Apakah Anda Yakin Menghapus Data Ini?")"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    <a href="/admin/admin/'. $row->id .'" class="btn btn-success btn-sm"><i class="far fa-eye"></i> Detail</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    
    public function index() {
        return view('admin.dataAdmin.index');
    }

    public function create() {
        //
    }

    public function store( StoreAdminRequest $request ) {
        //
    }

    public function show( Admin $admin ) {
        // dd($admin->users);
        return view( 'admin.dataAdmin.show', [
            'admin' => $admin,
        ] );
    }

    public function edit( Admin $admin ) {
        //
    }

    public function update( UpdateAdminRequest $request, Admin $admin ) {
        //
    }

    public function destroy( Admin $admin ) {
        //
    }
}