<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

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
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
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
        return view( 'admin.dataAdmin.create');
    }

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required|max:255',
            'age' => 'required|numeric|min:1',
            'no_hp' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'profession' => 'required|max:255',
            'no_member' => 'required|max:255',
            'image' => 'image|file|max:2048',
        ] );

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-photos');
        }
        $data_user = [
            'level_id' => 1,
            'username'=> $validatedData['username'],
            'email'=> $validatedData['email'],
            'password'=> bcrypt($validatedData['password']),
            'is_active' => '1',
        ];
        $user = User::create( $data_user );
        $user_last_id = $user->id;
        if($request->image != null){
            $data_admin = [
                'user_id' => $user_last_id,
                'name'=> $validatedData['name'],
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
                'image'=> $validatedData['image'],
            ];
        } else {
            $data_admin = [
                'user_id' => $user_last_id,
                'name'=> $validatedData['name'],
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
            ];
        }
        Admin::create( $data_admin );
        return redirect( '/admin/admin' )->with( 'success', 'Data Berhasil Ditambahkan!' );
    }

    public function show( Admin $admin ) {
        // dd($admin->users);
        return view( 'admin.dataAdmin.show', [
            'admin' => $admin,
        ] );
    }

    public function edit( Admin $admin ) {
        return view( 'admin.dataAdmin.edit', [
            'admin' => $admin,
            'users' => User::all(),
        ] );
    }

    public function update( Request $request, Admin $admin ) {
        try{
            $rules = [
                'name' => 'required|max:255',
                'username' => 'required|unique:users,username,'.$admin->users->id.'|max:255',
                'email' => 'required',
                'password'=>'nullable',
                'address' => 'required|max:255',
                'age' => 'required|numeric|min:1',
                'no_hp' => 'required|numeric|min:1',
                'gender' => 'required|in:Laki-Laki,Perempuan',
                'profession' => 'required|max:255',
                'no_member' => 'required|max:255',
                'image' => 'image|file|max:2048',
            ];
            
            if($request->password != null){
                $rules['password'] = 'max:20';
            }
            $validatedData = $request->validate( $rules );
            if($request->password != null){
                $data_user = [
                    'level_id' => 1,
                    'username'=> $validatedData['username'],
                    'email'=> $validatedData['email'],
                    'password'=> bcrypt($validatedData['password']),
                    
                ];
            } else {
                $data_user = [
                    'level_id' => 1,
                    'username'=> $validatedData['username'],
                    'email'=> $validatedData['email'],
                ];
            }
            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $validatedData['image'] = $request->file('image')->store('profile-photos');
            }
            if($request->image != null){
            $data_admin = [
                'name'=> $validatedData['name'],
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
                'image'=> $validatedData['image'],
                
            ];
        } else{
            $data_admin = [
                'name'=> $validatedData['name'],
                'address'=> $validatedData['address'],
                'age'=> $validatedData['age'],
                'no_hp'=> $validatedData['no_hp'],
                'gender'=> $validatedData['gender'],
                'profession'=> $validatedData['profession'],
                'no_member'=> $validatedData['no_member'],
                
            ];
        }
            $admin->users()->update($data_user);
            $admin->update($data_admin);
            return redirect( '/admin/admin' )->with( 'success', 'Data Berhasil Diupdate!' );
        } catch(QueryException $error){
            dd($error);
        }
    }

    public function destroy( Admin $admin ) {
        if ($admin->users->image) {
            Storage::delete($admin->users->image);
        }
        $admin->users()->delete();
        $admin->destroy($admin->id);
        return redirect( '/admin/admin' )->with( 'success', 'Data berhasil dihapus!' );
        
    }
}