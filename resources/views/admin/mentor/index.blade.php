@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Mentor</h2>
                            <h5 class="text-white op-7 mb-2">Data Mentor</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/mentor/create" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="fas fa-plus"></i> Tambah</a>
                            <a href="/admin/mentor/export_excel" class="btn btn-secondary btn-round"><i
                                    class="fas fa-file-excel" target="_blank"></i> Cetak Excel</a>
                            <a href="/admin/mentor/export_pdf" class="btn btn-secondary btn-round"><i
                                    class="fas fa-file-pdf" target="_blank"></i> Cetak PDF</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Tabel Data Mentor</h4>
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
                                        <table id="table" class="table table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Alamat</th>
                                                    <th>No.Telp</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($mentors as $mentor)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $mentor->name }}</td>
                                                        <td>{{ $mentor->username }}</td>
                                                        <td>{{ $mentor->email }}</td>
                                                        <td>{{ $mentor->address }}</td>
                                                        <td>{{ $mentor->no_hp }}</td>
                                                        <td>
                                                            <div class="action-button mx-auto text-end">
                                                                <a href="/admin/mentor/{{ $mentor->id }}/edit"
                                                                    class="badge btn-warning"><i class="far fa-edit""></i>
                                                                    Edit</a>
                                                                <form action="/admin/mentor/{{ $mentor->id }}"
                                                                    method="post" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button class="badge btn-danger border-0"
                                                                        onclick="return confirm('Are you sure?')"><i
                                                                            class="fas fa-trash"></i> Hapus</button>
                                                                </form>
                                                                <a href="/admin/mentor/{{ $mentor->id }}"
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
                ajax: "/admin/mentor/datamentor",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'nama lengkap'
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
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
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
