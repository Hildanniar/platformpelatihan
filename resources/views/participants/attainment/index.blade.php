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
                    </div>
                </div>
            </div>
            <!-- Attainment Start -->
            <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="container py-5">
                    <div class="row g-5">
                        @foreach ($attainment as $t)
                            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                                <div class="blog-item bg-light rounded overflow-hidden">
                                    <div class="blog-img position-relative overflow-hidden">
                                        @if ($t->image)
                                            <div style="max-height:500px; overflow:hidden;">
                                                <img src="{{ asset('storage/' . $t->image) }}" alt="{{ $t->image }}"
                                                    class="img-fluid">
                                            </div>
                                        @else
                                            <img src="https://source.unsplash.com/500x400?{{ $t->name }}"
                                                alt="{{ $t->name }}" class="img-fluid">
                                        @endif
                                        <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                            href="">{{ $t->type_trainings->name }}</a>
                                    </div>
                                    <div class="p-4">
                                        <div class="d-flex mb-3">
                                            <small class="me-3"><i
                                                    class="far fa-user text-primary me-2"></i>{{ auth()->user()->participants->name }}</small>
                                            {{-- <small><i class="far fa-calendar-alt text-primary me-2"></i></small> --}}
                                        </div>
                                        <h4 class="mb-3">{{ $t->materi_tasks->name }}</h4>
                                        <p>{{ $t->excerpt }}</p>
                                        <a class="text-uppercase"
                                            href="/participant/attainment/show/{{ $t->id }}">Read
                                            More <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Attainment Start -->

            {{-- pagination --}}
            <div class="d-flex justify-content-center">{{ $attainment->links() }}</div>
        </div>
        @include('participants.layouts.partials.footer')
    </div>
@endsection
