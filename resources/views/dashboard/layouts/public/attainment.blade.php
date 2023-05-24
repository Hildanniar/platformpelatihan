<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.partials.head')

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->

    @include('dashboard.layouts.partials.topbar')

    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        @include('dashboard.layouts.partials.navbar')
        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Karya Pelatihan</h1>
                    <a href="/" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="/attainment" class="h5 text-white">Karya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Attainment Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Latest Blog</h5>
                <h1 class="mb-0">Kumpulan Karya Pelatihan</h1>
            </div>
            <div class="row g-5">
                @foreach ($attainments as $t)
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
                                {{-- <img class="img-fluid" src="/assets/dashboard/img/blog-1.jpg" alt=""> --}}
                                <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                    href="">{{ $t->type_trainings->name }}</a>
                            </div>
                            <div class="p-4">
                                <div class="d-flex mb-3">
                                    <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                    <small><i class="far fa-calendar-alt text-primary me-2"></i></small>
                                </div>
                                <h4 class="mb-3">{{ $t->materi_tasks->name }}</h4>
                                <p>{{ $t->excerpt }}</p>
                                @if (auth()->user() == null)
                                    <a class="text-uppercase" href="/attainment/{{ $t->id }}">Read More <i
                                            class="bi bi-arrow-right"></i></a>
                                @elseif (auth()->user()->levels->name == 'Peserta')
                                    <a class="text-uppercase"
                                        href="/dashboard/participant/attainment/{{ $t->id }}">Read More <i
                                            class="bi bi-arrow-right"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Attainment Start -->

    {{-- pagination --}}
    <div class="d-flex justify-content-center">{{ $attainments->links() }}</div>


    @include('dashboard.layouts.partials.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('dashboard.layouts.partials.script')
</body>

</html>
