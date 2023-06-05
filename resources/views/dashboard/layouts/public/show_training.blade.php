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
                    <h1 class="display-4 text-white animated zoomIn">{{ $type_training->name }}</h1>
                    <a href="/" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="/training" class="h5 text-white">Pelatihan</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    {{-- Show Training Start --}}
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">

                <br>
                <center>
                    <h1>{{ $type_training->name }}</h1>
                </center>
                <p> </p>
                <p>Tersedia Kelas<span class="badge rounded-pill bg-warning text-dark"
                        style="text-align: right;">{{ $type_training->class }}</span>dengan kuota orang :<span
                        class="badge rounded-pill bg-warning text-dark"
                        style="text-align: right;">{{ $type_training->quota }}</span></p>
                @if ($type_training->image)
                    <div style="max-height:500px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $type_training->image) }}" alt="{{ $type_training->image }}"
                            class="card-img-top">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $type_training->name }}"
                        alt="{{ $type_training->name }}" class="card-img-top">
                @endif
                <article class="my-3 fs-6">
                    {!! $type_training->desc !!}
                </article>
                @foreach ($type_training->schedules as $s)
                    <p>Jadwal Pelatihan : <span class="badge rounded-pill bg-warning text-dark"
                            style="text-align: right;">{{ $s->start_date }} </span> s.d. <span
                            class="badge rounded-pill bg-warning text-dark"
                            style="text-align: right;">{{ $s->end_date }}</span></p>
                    <p>Waktu Pelatihan : <span class="badge rounded-pill bg-warning text-dark"
                            style="text-align: right;">{{ $s->start_time }} </span> s.d. <span
                            class="badge rounded-pill bg-warning text-dark"
                            style="text-align: right;">{{ $s->end_time }}</span></p>
                @endforeach
                @if ($trainingParticipants < $type_training->quota)
                    @if (auth()->user() == null)
                        <a class="btn btn-primary float-right" href="/login" role="button">Daftar Sekarang</a>
                    @elseif (auth()->user()->levels->name == 'Peserta')
                        <a class="btn btn-primary float-right" href="/regristration/{{ $type_training->id }}"
                            role="button">Daftar
                            Sekarang</a>
                    @endif
                @else
                    <button class="btn btn-danger float-right">Kuota Sudah Penuh</button>
                @endif
            </div>
        </div>
    </div>
    {{-- Show Training End --}}

    @include('dashboard.layouts.partials.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('dashboard.layouts.partials.script')
</body>

</html>
