@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Hasil Karya Pelatihan</h2>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/participant/attainment" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-10">
                        <br>
                        <center>
                            <h1>{{ $attainment->materi_tasks->name_materi }}</h1>
                        </center>

                        <p>By. {{ auth()->user()->participants->name }}</p>
                        @if ($attainment->image != null)
                            <div style="max-height:500px; overflow:hidden;">
                                <img src="{{ asset('storage/' . $attainment->image) }}" alt="{{ $attainment->image }}"
                                    class="card-img-top">
                            </div>
                        @else
                            <img src="https://source.unsplash.com/1200x400?{{ $attainment->materi_tasks->name_materi }}"
                                alt="{{ $attainment->materi_tasks->name_materi }}" class="card-img-top">
                        @endif
                        <article class="my-3 fs-6">
                            {!! $attainment->desc !!}
                        </article>

                        @if ($attainment->value == null)
                            <p>Nilai : <span class="badge rounded-pill bg-danger text-white"
                                    style="text-align: right;">Belum Dinilai</span></p>
                        @else
                            <p>Nilai : {{ $attainment->value }}</p>
                        @endif

                        <p>URL hasil karya
                            :
                            <span class="badge rounded-pill bg-warning text-white" style="text-align: right;"><a
                                    href="{{ $attainment->link }}" target="_blank" style="color:black"> klik disini</a>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @include('participants.layouts.partials.footer')
    </div>
@endsection
