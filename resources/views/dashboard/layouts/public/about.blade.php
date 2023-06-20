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
                    <img class="w-100" src="/assets/content-photo/pelatihan5.jpeg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="row py-5">
                            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                                <h1 class="display-4 text-white animated zoomIn">Tentang Kami</h1>
                                <a href="/" class="h5 text-white">Home</a>
                                <i class="far fa-circle text-white px-2"></i>
                                <a href="/about" class="h5 text-white">About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3"
                            placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">About Us</h5>
                        <h1 class="mb-0">Platform Pelatihan</h1>
                    </div>
                    <p class="mb-4">Platform Pelatihan ini disediakan oleh Dinas Perpustakaan dan Kearsipan
                        Kabupaten Madiun untuk mempermudah masyarakat dalam mencari informasi dan mendaftar pelatihan
                        secara gratis. Adanya platform pelatihan ini sebagai bentuk dukungan ke perpustakaan yang
                        menjadi tempat belajar mencari ilmu.</p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-9 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Pendaftaran gratis</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Mendapatkan Sertifikat</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Mendapatkan pengetahuan dan
                                skill baru</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Diajarkan oleh Mentor yang
                                berpengalaman dibidangnya</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call to ask any question</h5>
                            <h4 class="text-primary mb-0">0351-383473</h4>
                        </div>
                    </div>
                    {{-- <a href="quote.html" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Request
                        A Quote</a> --}}
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s"
                            src="/assets/content-photo/pelatihan9.jpeg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    @include('dashboard.layouts.partials.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('dashboard.layouts.partials.script')
</body>

</html>
