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
                                <a href="/participant/training" class="btn btn-white btn-border btn-round mr-2"><i
                                        class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-8">
                            <h1>{{ $m->bab_materi }} <br> {{ $m->name_materi }}</h1>
                            @if ($m->type_trainings->image)
                                <div style="max-height:500px; overflow:hidden;">
                                    <img src="{{ asset('storage/' . $m->type_trainings->image) }}"
                                        alt="{{ $m->type_trainings->image }}" class="card-img-top">
                                </div>
                            @else
                                <img src="https://source.unsplash.com/1200x400?{{ $m->type_trainings->image }}"
                                    alt="{{ $m->type_trainings->image }}" class="card-img-top">
                            @endif

                            <article class="my-3 fs-6">
                                {!! $m->body_materi !!}
                            </article>
                        </div>
                    </div>
                </div>
    @endforeach
    </div>
    @include('participants.layouts.partials.footer')
    </div>
@endsection
