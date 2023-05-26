@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            @foreach ($materiTask as $m)
                <div class="panel-header bg-primary-gradient">

                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h3 class="text-white pb-2 fw-bold">Anda Mengikuti Pelatihan {{ $m->type_trainings->name }}
                                    Kelas {{ $m->type_trainings->class }}</h3>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="/participant/training" class="btn btn-white btn-border btn-round mr-2"><i
                                        class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <div class="container">
                    <div class="row">

                        <div class="col-md-4">
                            <a href="/participant/materi/{{ $m->id }}">
                                {{-- <a href="/materi_tasks?name_materi={{ $m->name_materi }}"> --}}
                                <div class="card bg-dark text-white">
                                    <img src="https://source.unsplash.com/500x500?{{ $m->type_trainings->name }}"
                                        class="card-img" alt="{{ $m->bab_materi }}">
                                    <div class="card-img-overlay d-flex align-items-center p-0">
                                        <h5 class="card-title text-center text-white flex-fill p-4 fs-3"
                                            style="background-color: rgba(0,0,0,0.7)">
                                            {{ $m->bab_materi }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
            @endforeach
        </div>
    </div>

    </div>
    @include('participants.layouts.partials.footer')
    </div>
@endsection
