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
        {{-- <div class="container-fluid bg-primary py-5" style="margin-bottom: 90px;"> --}}
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="/assets/content-photo/pelatihan6.jpeg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="row py-5">
                            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                                <h1 class="display-4 text-white animated zoomIn">Pelatihan</h1>
                                <a href="/" class="h5 text-white">Home</a>
                                <i class="far fa-circle text-white px-2"></i>
                                <a href="/training" class="h5 text-white">Pelatihan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- training Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Pelatihan</h5>
                <h1 class="mb-0">Tingkatkan Skillmu dengan mengikuti Pelatihan dibawah ini!!!</h1>
            </div>
            <div class="row g-5">
                @foreach ($typeTrainings as $t)
                    <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                        <div
                            class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="service-icon">
                                <i class="fa fa-shield-alt text-white"></i>
                            </div>
                            <h4 class="mb-3">{{ $t->name }}</h4>
                            <p class="m-0">{{ $t->excerpt }}</p>
                            @if (auth()->user() == null)
                                <a class="btn btn-lg btn-primary rounded" href="/training/{{ $t->id }}">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            @elseif (auth()->user()->levels->name == 'Peserta')
                                <a class="btn btn-lg btn-primary rounded"
                                    href="/dashboard/participant/training/{{ $t->id }}">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- training End -->

    {{-- pagination --}}
    <div class="d-flex justify-content-center">{{ $typeTrainings->links() }}</div>

    @include('dashboard.layouts.partials.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('dashboard.layouts.partials.script')
</body>

</html>
