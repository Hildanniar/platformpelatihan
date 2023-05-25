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

    <form method="POST" action="/regristration/add/{{ $type_training->id }}" class="mb-5"
        enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row gutters">
                <center>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row gutters">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success col-lg-12" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-2 text-primary">Daftar Pelatihan</h6>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <br>
                                        <div class="form-group">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text"
                                                class="form-control input-solid @error('name') is-invalid @enderror"
                                                name="name" placeholder="Masukkan Nama Lengkap" value=""
                                                required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <br>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text"
                                                class="form-control input-solid @error('address') is-invalid @enderror"
                                                name="address" placeholder="Masukkan Alamat" value="" required>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <br>
                                        <div class="form-group">
                                            <label for="age">Umur</label>
                                            <input type="text"
                                                class="form-control input-solid @error('age') is-invalid @enderror"
                                                name="age" placeholder="Masukkan Umur" value="" required>
                                            @error('age')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <br>
                                        <div class="form-group">
                                            <label for="no_hp">No.HP</label>
                                            <input type="text"
                                                class="form-control input-solid @error('no_hp') is-invalid @enderror"
                                                name="no_hp" placeholder="Masukkan No.HP" value="" required>
                                            @error('no_hp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <br>
                                        <div class="form-group">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select
                                                class="form-control input-solid @error('gender') is-invalid @enderror"
                                                id="gender" required name="gender">
                                                <option selected disabled value="">Silahkan dipilih...</option>
                                                <option value="Laki-Laki"
                                                    @if (old('gender') == 'Laki-Laki') selected @endif>
                                                    Laki-Laki</option>
                                                <option value="Perempuan"
                                                    @if (old('gender') == 'Perempuan') selected @endif>
                                                    Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <br>
                                        <div class="form-group">
                                            <label for="profession">Pekerjaan</label>
                                            <input type="text"
                                                class="form-control input-solid @error('profession') is-invalid @enderror"
                                                name="profession" placeholder="Masukkan Pekerjaan" value=""
                                                required>
                                            @error('profession')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <br>
                                        <div class="form-group">
                                            <label for="no_member">No.Anggota Perpustakaan</label>
                                            <input type="text"
                                                class="form-control input-solid @error('no_member') is-invalid @enderror"
                                                name="no_member" placeholder="Masukkan No.Anggota Perpustakaan"
                                                value="">
                                            @error('no_member')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <br>
                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <button type="submit" class="btn btn-primary text-white">Daftar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </form>

    @include('dashboard.layouts.partials.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('dashboard.layouts.partials.script')
</body>

</html>
