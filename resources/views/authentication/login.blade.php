<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</head>
<!-- Section: Design Block -->
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background: rgb(21, 112, 209);
        height: 200px;
        ">
        <h1 class="text-white">LOGIN USER</h1>
    </div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong"
        style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
        <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5">Selamat Datang di Platform Pelatihan
                        Dinas Perpustakaan dan Kearsipan
                        Kabupaten Madiun</h2>
                    @if (session()->has('login_error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            {{ session('login_error') }}
                        </div>
                    @endif
                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label class="justify-content-start" for="emailandusername">Email atau Username</label>
                            <input type="text" name="emailandusername"
                                class="form-control form-control-xl @error('emailandusername') is-invalid @enderror"
                                placeholder="Masukkan Email atau Username">
                            <div class="form-control-icon">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            @error('emailandusername')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="emailandusername">Password</label>
                            <input type="password" name="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="Masukkan Password">
                            <div class="form-control-icon">
                                <i class="fa-regular fa-shield-keyhole"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-3 captcha">
                                    <span>{!! captcha_img() !!}</span>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary btn-block" class="reload"
                                        id="reload">&#x21bb;</button>
                                </div>
                                <div class="col-md-6">
                                    <input id="captcha" type="text"
                                        class="form-control form-control-xl @error('captcha') is-invalid @enderror"
                                        placeholder="Masukkan Captcha" name="captcha">
                                    @error('captcha')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg">Masuk</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="text-gray-600">Belum memiliki akun? <a href="/register" class="font-bold">Register</a>
                        </p>
                        {{-- <p><a class="font-bold" href="auth-forgot-password.html">Lupa password?</a></p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->
