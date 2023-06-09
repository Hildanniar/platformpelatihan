@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            @if (auth()->user()->levels->name == 'Peserta')
                                @if ($trainingParticipants->participant_id == null)
                                    <h2 class="text-white pb-2 fw-bold">Silahkan Daftar Pelatihan
                                    </h2>
                                @else
                                    <h2 class="text-white pb-2 fw-bold">Selamat Datang
                                        {{ auth()->user()->participants->name }}!
                                    </h2>
                                @endif
                            @else
                                <h2 class="text-white pb-2 fw-bold">Silahkan Daftar Pelatihan
                                </h2>
                            @endif
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
                                        @if (auth()->user()->levels->name == 'Peserta')
                                            @if ($trainingParticipants->participant_id == null)
                                                <h4 class="card-title">Silahkan memilih jenis pelatihan yang akan
                                                    anda ikuti
                                                </h4>
                                            @else
                                                <h4 class="card-title">Anda memiliki pelatihan
                                                    {{ $trainingParticipants->type_trainings->name }}
                                                </h4>
                                            @endif
                                        @else
                                            <h4 class="card-title">Silahkan memilih jenis pelatihan yang akan
                                                anda ikuti
                                            </h4>
                                        @endif
                                    </blockquote>
                                    <div class="col-12 col-stats">
                                        @if (auth()->user()->levels->name == 'Peserta')
                                            @if ($trainingParticipants->participant_id == null)
                                                <a href="/dashboard/participant/training"
                                                    class="btn btn-secondary btn-round text-white">Daftar Sekarang</a>
                                            @else
                                                <a href="/participant/training"
                                                    class="btn btn-secondary btn-round text-white">Mulai
                                                    Sekarang</a>
                                            @endif
                                        @else
                                            <a href="/dashboard/participant/training"
                                                class="btn btn-secondary btn-round text-white">Daftar Sekarang</a>
                                        @endif
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
