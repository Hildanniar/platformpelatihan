@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Selamat Datang {{ auth()->user()->participants->name }}!
                            </h2>
                            <h5 class="text-white op-7 mb-2">Semoga belajarmu menyenangkan</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row row-card-no-pd mt--2">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-9 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Status Pelatihan
                                            </p>
                                        </div>
                                    </div>
                                    <blockquote class="col-12">
                                        <h4 class="card-title">Silahkan memilih jenis pelatihan yang akan
                                            anda ikuti
                                        </h4>
                                    </blockquote>
                                    <div class="col-12 col-stats">
                                        <a href="/dashboard/participant/type_training"
                                            class="btn btn-secondary btn-round">Daftar Sekarang</a>
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
@endsection