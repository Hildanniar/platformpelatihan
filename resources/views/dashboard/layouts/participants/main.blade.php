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

    {{-- Carousel Start --}}
    <div class="container-fluid position-relative p-0">
        @include('dashboard.layouts.partials.navbar')
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="/assets/dashboard/img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Selamat Datang</h5>
                            <h2 class="display-1 text-white mb-md-4 animated zoomIn">Platform Pelatihan</h2>
                            <a href="/dashboard/participant/start"
                                class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Mulai
                                Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="/assets/dashboard/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Dinas Perpustakaan dan
                                Kearsipan
                                Kabupaten Madiun</h5>
                            <h2 class="display-1 text-white mb-md-4 animated zoomIn">Platform Pelatihan</h2>
                            <a href="/dashboard/participant/start"
                                class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Mulai
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    {{-- Carousel End --}}

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


    <!-- Facts Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4"
                        style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Peserta Pelatihan</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">{{ $users }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4"
                        style="height: 150px;">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-check text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Jenis Pelatihan</h5>
                            <h1 class="mb-0" data-toggle="counter-up">{{ $type_trainings }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4"
                        style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-award text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Karya Pelatihan</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">{{ $attainments }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts Start -->


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
                    {{-- <div class="row g-0 mb-3">
                        <div class="col-sm-9 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Pendaftaran gratis</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Mendapatkan Sertifikat
                            </h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Mendapatkan pengetahuan
                                dan
                                skill baru</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Diajarkan oleh Mentor yang
                                berpengalaman dibidangnya</h5>
                        </div>
                    </div> --}}
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
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s"
                            src="/assets/dashboard/img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Why Choose Us Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Kenapa Memilih Kami</h5>
                <h1 class="mb-0">Kami Hadir untuk Mengembangkan Keahlian Anda</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-cubes text-white"></i>
                            </div>
                            <h4>Pendaftaran gratis</h4>
                            {{-- <p class="mb-0">Pelatihan dilakukan secara gratis
                            </p> --}}
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-award text-white"></i>
                            </div>
                            <h4>Mendapatkan Sertifikat</h4>
                            {{-- <p class="mb-0">Magna sea eos sit dolor, ipsum amet lorem diam dolor eos et diam dolor
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s"
                            src="/assets/dashboard/img/feature.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-check text-white"></i>
                            </div>
                            <h4>Mendapatkan pengetahuan
                                dan
                                skill baru</h4>
                            {{-- <p class="mb-0">Magna sea eos sit dolor, ipsum amet lorem diam dolor eos et diam dolor
                            </p> --}}
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-users-cog text-white"></i>
                            </div>
                            <h4>Mentor yang
                                berpengalaman dibidangnya</h4>
                            {{-- <p class="mb-0">Magna sea eos sit dolor, ipsum amet lorem diam dolor eos et diam dolor
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Start -->


    <!-- Training Start -->
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
                            <a class="btn btn-lg btn-primary rounded"
                                href="/dashboard/participant/training/{{ $t->id }}">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div
                        class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <h3> <a class="text-white mb-3" href="/dashboard/participant/training">Lihat Pelatihan
                                Lainnya...</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Training End -->

    <!-- Testimonial Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Testimoni</h5>
                <h1 class="mb-0">Apa Kata Klien Kami Tentang Platform Pelatihan Kami</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
                @foreach ($trainingParticipants as $par)
                    <div class="testimonial-item bg-light my-4">
                        <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                            @if ($par->participants->image == null)
                                <img src="/assets/admin/img/profiledefault.png" alt="..."
                                    class="img-fluid rounded" style="width: 60px; height: 60px;">
                            @else
                                <img src="{{ asset('storage/' . $par->participants->image) }}" alt="..."
                                    class="img-fluid rounded" style="width: 60px; height: 60px;">
                            @endif

                            <div class="ps-4">
                                <h4 class="text-primary mb-1">{{ $par->participants->name }}</h4>
                                <small class="text-uppercase">{{ $par->participants->profession }}</small>
                            </div>
                        </div>
                        <div class="pt-4 pb-5 px-5">
                            {!! $par->comment !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Attainment Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Latest Blog</h5>
                <h1 class="mb-0">Kumpulan Karya Pelatihan</h1>
            </div>
            <div class="row g-5">
                @foreach ($attainment as $at)
                    <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                        <div class="blog-item bg-light rounded overflow-hidden">
                            <div class="blog-img position-relative overflow-hidden">
                                @if ($at->image)
                                    <div style="max-height:500px; overflow:hidden;">
                                        <img src="{{ asset('storage/' . $at->image) }}" alt="{{ $at->image }}"
                                            class="img-fluid">
                                    </div>
                                @else
                                    <img src="https://source.unsplash.com/500x400?{{ $at->name }}"
                                        alt="{{ $at->name }}" class="img-fluid">
                                @endif
                                {{-- <img class="img-fluid" src="/assets/dashboard/img/blog-1.jpg" alt=""> --}}
                                <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                    href="">{{ $at->type_trainings->name }}</a>
                            </div>
                            <div class="p-4">
                                <div class="d-flex mb-3">
                                    <small class="me-3"><i
                                            class="far fa-user text-primary me-2"></i>{{ $at->participants->name }}</small>
                                    {{-- <small><i class="far fa-calendar-alt text-primary me-2"></i></small> --}}
                                </div>
                                {{-- <h4 class="mb-3">{{ $at->materi_tasks->name }}</h4> --}}
                                <p>{{ $at->excerpt }}</p>
                                <a class="text-uppercase"
                                    href="/dashboard/participant/attainment/{{ $at->id }}">Read More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div
                        class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <h3> <a class="text-white mb-3" href="/dashboard/participant/attainment">Lihat Hasil Karya
                                Lainnya...</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Attainment Start -->


    <!-- Survey Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Survey Rekomendasi Pelatihan</h5>
                        <h1 class="mb-0">Berikan pendapat Anda sekarang juga!!!
                        </h1>
                    </div>
                    <p class="mb-4">Adanya Survey Rekomendasi Pelatihan untuk mengumpulkan data rekomendasi pelatihan
                        guna menentukan jenis dan pelaksanaan pelatihan gratis selanjutnya</p>
                </div>
                <div class="col-lg-5">
                    <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn"
                        data-wow-delay="0.9s">
                        <form method="post" action="/" class="mb-5" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-xl-12">
                                    <input type="text" name="name"
                                        class="form-control bg-light border-0 @error('name') is-invalid @enderror"
                                        placeholder="Masukkan Nama Lengkap" style="height: 40px;" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="age"
                                        class="form-control bg-light border-0 @error('age') is-invalid @enderror"
                                        placeholder="Masukkan Usia" style="height: 40px;" required>
                                    @error('age')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="address"
                                        class="form-control bg-light border-0 @error('address') is-invalid @enderror"
                                        placeholder="Masukkan Alamat" style="height: 40px;" required>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="profession"
                                        class="form-control bg-light border-0 @error('profession') is-invalid @enderror"
                                        placeholder="Masukkan Pekerjaan" style="height: 40px;" required>
                                    @error('profession')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="quota"
                                        class="form-control bg-light border-0 @error('quota') is-invalid @enderror"
                                        placeholder="Masukkan Jumlah Kuota" style="height: 40px;" maxlength="1"
                                        required>
                                    <small style="color:red">*atau jumlah teman yang ingin anda ajak</small>
                                    @error('quota')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="type_training"
                                        class="form-control bg-light border-0 @error('type_training') is-invalid @enderror"
                                        placeholder="Masukkan Jenis Pelatihan" style="height: 40px;" required>
                                    @error('type_training')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <select class="form-select bg-light border-0 @error('month') is-invalid @enderror"
                                        name="month" style="height: 40px;" required>
                                        <option selected disabled value="">Pilih Bulan Pelaksanaan</option>
                                        <option value="Januari" @if (old('month') == 'Januari') selected @endif>
                                            Januari</option>
                                        <option value="Februari" @if (old('month') == 'Februari') selected @endif>
                                            Februari</option>
                                        <option value="Maret" @if (old('month') == 'Maret') selected @endif>Maret
                                        </option>
                                        <option value="April" @if (old('month') == 'April') selected @endif>April
                                        </option>
                                        <option value="Mei" @if (old('month') == 'Mei') selected @endif>Mei
                                        </option>
                                        <option value="Juni" @if (old('month') == 'Juni') selected @endif>Juni
                                        </option>
                                        <option value="Juli" @if (old('month') == 'Juli') selected @endif>Juli
                                        </option>
                                        <option value="Agustus" @if (old('month') == 'Agustus') selected @endif>
                                            Agustus</option>
                                        <option value="September" @if (old('month') == 'September') selected @endif>
                                            September</option>
                                        <option value="Oktober" @if (old('month') == 'Oktober') selected @endif>
                                            Oktober</option>
                                        <option value="November" @if (old('month') == 'November') selected @endif>
                                            November</option>
                                        <option value="Desember" @if (old('month') == 'Desember') selected @endif>
                                            Desember</option>
                                    </select>
                                    @error('month')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control bg-light border-0 @error('excuse') is-invalid @enderror" name="excuse" rows="3"
                                        placeholder="Alasan memilih Jenis Pelatihan tersebut" required></textarea>
                                    @error('excuse')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" type="submit">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Survey End -->

    @include('dashboard.layouts.partials.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('dashboard.layouts.partials.script')

</body>

</html>
