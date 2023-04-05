@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Pengguna</h2>
                            <h5 class="text-white op-7 mb-2">Data Pengguna</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/pengguna/create" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="fas fa-plus"></i> Tambah</a>
                            <a href="/admin/pengguna/export_excel" class="btn btn-secondary btn-round"><i
                                    class="fas fa-file-excel" target="_blank"></i> Cetak
                                Excel</a>
                            <button href="/admin/pengguna/export_pdf" class="btn btn-secondary btn-round"><i
                                    class="fas fa-file-pdf" target="_blank"></i> Cetak PDF</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Tabel Data Pengguna</h4>
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success col-lg-8" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive table-hover">
                                        <table id="table" class="table table-hover table-responsive table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>No.Telp</th>
                                                    <th>Alamat</th>
                                                    <th>Level</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->no_hp }}</td>
                                                        <td>{{ $user->address }}</td>
                                                        <td>{{ $user->id_level }}</td>
                                                        <td>
                                                            <div class="action-button mx-auto text-end">
                                                                <a href="/admin/pengguna/{{ $user->id }}/edit"
                                                                    class="badge btn-warning"><i class="far fa-edit""></i>
                                                                    Edit</a>
                                                                <form action="/admin/pengguna/{{ $user->id }}"
                                                                    method="post" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button class="badge btn-danger border-0"
                                                                        onclick="return confirm('Are you sure?')"><i
                                                                            class="fas fa-trash"></i> Hapus</button>
                                                                </form>
                                                                <a href="/admin/pengguna/{{ $user->id }}"
                                                                    class="badge btn-success"><i class="far fa-eye"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Dinas Perpustakaan dan Kearsipan Kabupaten Madiun
                            </a>
                        </li>
                </nav>
                <div class="copyright ml-auto">
                    Copyright
                </div>
            </div>
        </footer>
    </div>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/admin/pengguna/datapengguna",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'id_level',
                        name: 'id_level'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        });
    </script>
@endsection
