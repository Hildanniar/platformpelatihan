@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                            <h5 class="text-white op-7 mb-2">Admin Dashboard</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card With Icon States Background -->
            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="flaticon-users"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Peserta</p>
                                            <h4 class="card-title">{{ $users }}</h4>
                                            <div class="card-footer d-flex justify-content-between">
                                                <a class="small text-black stretched-link"
                                                    href="{{ url('/admin/participant') }}">View details</a>
                                                <div class="small text-white"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="flaticon-layers"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Pelatihan</p>
                                            <h4 class="card-title">{{ $type_trainings }}</h4>
                                            <div class="card-footer d-flex justify-content-between">
                                                <a class="small text-black stretched-link"
                                                    href="{{ url('/admin/type_training') }}">View details</a>
                                                <div class="small text-white"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="
                                        flaticon-web-1"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Karya Pelatihan</p>
                                            <h4 class="card-title">{{ $attainments }}</h4>
                                            <div class="card-footer d-flex justify-content-between">
                                                <a class="small text-black stretched-link"
                                                    href="{{ url('/admin/attainment') }}">View details</a>
                                                <div class="small text-white"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection
