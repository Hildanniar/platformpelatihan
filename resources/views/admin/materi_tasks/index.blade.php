@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Materi & Tugas</h2>
                            <h5 class="text-white op-7 mb-2">Data Materi & Tugas</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/materi_tasks/create" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="fas fa-plus"></i> Tambah</a>
                            {{-- <a href="#" class="btn btn-secondary btn-round"><i class="fas fa-print"></i> Cetak</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Tabel Data Materi & Tugas</h4>
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">
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
                                                    <th>Bab Materi</th>
                                                    <th>Kutipan Materi</th>
                                                    <th>Nama Tugas</th>
                                                    <th>Tanggal Mulai</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
        @include('admin.layouts.partials.footer')
    </div>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/admin/materi_tasks/datamateritasks",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'jenis pelatihan'
                    },
                    {
                        data: 'bab_materi',
                        name: 'bab'
                    },
                    {
                        data: 'excerpt_materi',
                        name: 'kutipan'
                    },
                    {
                        data: 'name_task',
                        name: 'nama tugas'
                    },
                    {
                        data: 'start_date',
                        name: 'tanggal mulai'
                    },
                    {
                        data: 'end_date',
                        name: 'tanggal akhir'
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
