@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Jenis Pelatihan</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                {{-- <h4 class="card-title">Tabel Jenis Pelatihan</h4> --}}
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
                                        <table id="table" class="table table-hover table-responsive"
                                            style="table-layout: fixed; word-wrap: break-word;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis Pelatihan</th>
                                                    <th width="100px">Materi</th>
                                                    <th width="100px">Jadwal</th>
                                                    <th width="100px">Sertifikat</th>
                                                    <th width="100px">Komentar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <small style="color:red">*Tombol Materi warna Merah berarti anda mengikuti
                                            kelas online</small> <br>
                                        <small style="color:red">*Tombol Materi warna Kuning berarti anda mengikuti
                                            kelas offline</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('participants.layouts.partials.footer')
    </div>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/participant/training/datatraining",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'type_training_id',
                        name: 'jenis pelatihan'
                    },
                    {
                        data: 'materi',
                        name: 'materi'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'certificate',
                        name: 'certificate'
                    },
                    {
                        data: 'comment',
                        name: 'comment',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        });
    </script>
@endsection
