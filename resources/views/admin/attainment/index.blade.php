@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Hasil Karya Pelatihan</h2>
                            <h5 class="text-white op-7 mb-2">Data Hasil Karya Pelatihan</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/attainment/create" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="fas fa-plus"></i> Tambah</a>
                            <a href="#" class="btn btn-secondary btn-round"><i class="fas fa-print"></i> Cetak</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Tabel Data Hasil Karya Pelatihan</h4>
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
                                                    <th>Jenis Pelatihan</th>
                                                    <th>Nama Peserta</th>
                                                    <th>Ulasan</th>
                                                    <th>Status</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($attainment as $a)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $a->id_training }}</td>
                                                        <td>{{ $a->id_user }}</td>
                                                        <td>{{ $a->comment }}</td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckDefault">
                                                                <label class="form-check-label"
                                                                    for="flexSwitchCheckDefault">Default switch checkbox
                                                                    input</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="action-button mx-auto text-end">
                                                                <a href="/admin/attainment/{{ $a->id }}/edit"
                                                                    class="badge btn-warning"><i class="far fa-edit""></i>
                                                                    Edit</a>
                                                                <form action="/admin/attainment/{{ $a->id }}"
                                                                    method="post" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button class="badge btn-danger border-0"
                                                                        onclick="return confirm('Are you sure?')"><i
                                                                            class="fas fa-trash"></i> Hapus</button>
                                                                </form>
                                                                <a href="/admin/attainment/{{ $a->id }}"
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
                ajax: '/admin/attainment/dataattainment',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'jenis pelatihan'
                    },
                    {
                        data: 'name_user',
                        name: 'nama peserta'
                    },
                    {
                        data: 'comment',
                        name: 'comment'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                // "fnDrawCallback": function(row) {
                //     $('.status')
                //         .prop('checked', row.status !== 1)
                //         .bootstrapToggle();
                // }
            });
        });
    </script>
@endsection
