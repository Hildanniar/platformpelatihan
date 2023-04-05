@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Survey Pelatihan</h2>
                            <h5 class="text-white op-7 mb-2">Data Survey Pelatihan</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/survey" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="far fa-arrow-alt-circle-left"></i></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content bd bd-gray-100 bd-t-0 pd-20" id="myTabContent">
                <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                    <div class="card border-0 bg-white-9 rounded-xl p-0 mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>:</th>
                                        <td> {{ $surveys->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usia</th>
                                        <th>:</th>
                                        <td> {{ $surveys->age }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kota Asal</th>
                                        <th>:</th>
                                        <td> {{ $surveys->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <th>:</th>
                                        <td> {{ $surveys->profession }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rekomendasi Pelatihan</th>
                                        <th>:</th>
                                        <td> {{ $surveys->type_training }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bulan Pelaksanaan</th>
                                        <th>:</th>
                                        <td> {{ $surveys->month }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alasan</th>
                                        <th>:</th>
                                        <td> {{ $surveys->excuse }}</td>
                                    </tr>
                                </table>
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
    @endsection
