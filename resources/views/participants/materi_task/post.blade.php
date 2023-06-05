@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">

                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">{{ $materiTask->type_trainings->name }}</h2>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            @if ($materiTask->file_materi)
                                <a href="/download/{{ $materiTask->id }}" class="btn btn-white btn-border btn-round mr-2"
                                    role="button">Download
                                    Materi</a>
                            @else
                            @endif

                            <a href="/participant/materi_task/{{ $materiTask->type_trainings->id }}"
                                class="btn btn-white btn-border btn-round mr-2"><i class="far fa-arrow-alt-circle-left"></i>
                                Kembali</a>
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
                            <h1>{{ $materiTask->bab_materi }} <br>{{ $materiTask->name_materi }}</h1>
                        </center>
                        @if ($materiTask->type_trainings->image)
                            <div style="max-height:500px; overflow:hidden;">
                                <img src="{{ asset('storage/' . $materiTask->type_trainings->image) }}"
                                    alt="{{ $materiTask->type_trainings->image }}" class="card-img-top">
                            </div>
                        @else
                            <img src="https://source.unsplash.com/1200x400?{{ $materiTask->type_trainings->name }}"
                                alt="{{ $materiTask->type_trainings->name }}" class="card-img-top">
                        @endif
                        <article class="my-3 fs-6">
                            {!! $materiTask->body_materi !!}
                        </article>
                    </div>
                </div>

                <hr color="black">
                {{-- tugas pelatihan --}}
                <div class="row justify-content-center mb-5">
                    <div class="col-md-10">
                        <span class="badge rounded-pill bg-warning text-dark" style="text-align: right;">tugas</span>
                        <center>
                            <h1>{{ $materiTask->name_task }}</h1>
                        </center>
                        <article class="my-3 fs-6">
                            {!! $materiTask->desc_task !!}
                            <b>
                                <span class="badge bg-danger text-white">Waktu Penugasan Mulai
                                    {{ date('d-m-Y', strtotime($materiTask->start_date)) }} s.d.
                                    {{ date('d-m-Y', strtotime($materiTask->end_date)) }}</span>
                            </b>
                            @if ($attainments)
                                <button type="button" class="btn btn-success float-right text-white">Sudah
                                    Mengupload
                                    Hasil
                                    Karya</button>
                            @else
                                @if ($today > $materiTask->end_date)
                                    <button type="button" class="btn btn-danger float-right text-white">Sudah Melewati
                                        Batas Waktu</button>
                                @else
                                    <a class="btn btn-primary float-right text-white"
                                        href="/participant/attainment/{{ $materiTask->id }}" role="button">Upload
                                        Hasil Karya</a>
                                @endif
                            @endif

                        </article>
                    </div>
                </div>
            </div>
        </div>
        @include('participants.layouts.partials.footer')
    </div>
@endsection
