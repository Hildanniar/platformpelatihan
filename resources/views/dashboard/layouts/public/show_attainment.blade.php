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
                    <h1 class="display-4 text-white animated zoomIn">{{ $attainment->materi_tasks->name_materi }}</h1>
                    <a href="/" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="/training" class="h5 text-white">Pelatihan</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">

                <br>
                <center>
                    <h1>{{ $attainment->materi_tasks->name_materi }}</h1>
                </center>
                <p>By.</p>
                <img src="https://source.unsplash.com/1200x400?{{ $attainment->materi_tasks->name_materi }}"
                    alt="{{ $attainment->materi_tasks->name_materi }}" class="card-img-top">
                <article class="my-3 fs-6">
                    {!! $attainment->desc !!}
                </article>
                <p>link hasil karya : </p>
            </div>
        </div>
    </div>
    @include('dashboard.layouts.partials.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('dashboard.layouts.partials.script')
</body>

</html>
