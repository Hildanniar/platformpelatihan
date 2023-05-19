@extends('participants.layouts.main')
@section('container')
    @foreach ($materiTask->materi_tasks as $m)
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">

                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">{{ $m->type_trainings->name }}</h2>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                {{-- <a href="/posts" class="btn btn-white btn-border btn-round mr-2" role="button">Upload Hasil
                                    Karya</a> --}}
                                <a href="/posts" class="btn btn-white btn-border btn-round mr-2" role="button">Lihat
                                    Materi</a>
                                <a href="/participant/training" class="btn btn-white btn-border btn-round mr-2"><i
                                        class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- materi pelatihan --}}
                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-10">
                            <br>
                            <span class="badge rounded-pill bg-warning text-dark" style="text-align: right;">materi</span>
                            <center>
                                <h1>{{ $m->bab_materi }} <br>{{ $m->name_materi }}</h1>
                            </center>
                            @if ($m->type_trainings->image)
                                <div style="max-height:500px; overflow:hidden;">
                                    <img src="{{ asset('storage/' . $m->type_trainings->image) }}"
                                        alt="{{ $m->type_trainings->image }}" class="card-img-top">
                                </div>
                            @else
                                <img src="https://source.unsplash.com/1200x400?{{ $m->type_trainings->name }}"
                                    alt="{{ $m->type_trainings->name }}" class="card-img-top">
                            @endif

                            <article class="my-3 fs-6">
                                {!! $m->body_materi !!}
                            </article>
                        </div>
                    </div>
                </div>
                <hr color="black">
                {{-- tugas pelatihan --}}
                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-10">
                            <span class="badge rounded-pill bg-warning text-dark" style="text-align: right;">tugas</span>
                            <center>
                                <h1>{{ $m->name_task }}</h1>
                            </center>

                            <article class="my-3 fs-6">
                                {!! $m->desc_task !!}
                                <b>
                                    <span class="badge bg-danger text-white">Waktu Penugasan Mulai
                                        {{ $m->start_date }} s.d. {{ $m->end_date }}</span>
                                </b>
                                <a class="btn btn-primary float-right" href="/participant/attainment" role="button">Upload
                                    Hasil Karya</a>
                            </article>
                        </div>
                    </div>
                </div>
    @endforeach
    </div>
    @include('participants.layouts.partials.footer')
    </div>
@endsection
