@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Materi Pelatihan</h2>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/participant/training" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($materiTask->materi_tasks as $m)
            @endforeach
        </div>
        @include('participants.layouts.partials.footer')
    </div>
@endsection
