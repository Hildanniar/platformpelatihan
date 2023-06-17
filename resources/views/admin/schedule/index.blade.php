@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Jadwal Pelatihan</h2>
                            <h5 class="text-white op-7 mb-2">Data Jadwal Pelatihan</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/schedule/create" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="fas fa-plus"></i> Tambah</a>
                            {{-- <a href="/admin/schedule/export_excel" class="btn btn-secondary btn-round"><i
                                    class="fas fa-file-excel" target="_blank"></i> Cetak Excel</a>
                            <a href="/admin/schedule/export_pdf" class="btn btn-secondary btn-round"><i
                                    class="fas fa-file-pdf"></i> Cetak PDF</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Tabel Data Jadwal Pelatihan</h4>
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
                                                    <th>Tanggal Mulai</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th>Jam Mulai</th>
                                                    <th>Jam Akhir</th>
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
                ajax: '/admin/schedule/dataschedule',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'jenis pelatihan'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'start_time',
                        name: 'start_time'
                    },
                    {
                        data: 'end_time',
                        name: 'end_time'
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
