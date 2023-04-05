<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Platform Pelatihan</title>
    <link rel="stylesheet" href="/assets/login/css/main/app.css">
    <link rel="stylesheet" href="/assets/login/css/pages/auth.css">
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/logodinas.png') }}" type="image/x-icon" />
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/fontawesome.min.css"
        integrity="sha512-cHxvm20nkjOUySu7jdwiUxgGy11vuVPE9YeK89geLMLMMEOcKFyS2i+8wo0FOwyQO/bL8Bvq1KMsqK4bbOsPnA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/brands.min.css"
        integrity="sha512-L+sMmtHht2t5phORf0xXFdTC0rSlML1XcraLTrABli/0MMMylsJi3XA23ReVQkZ7jLkOEIMicWGItyK4CAt2Xw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/assets/jquery/jquery-3.6.3.min.js"></script>
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-5 d-none d-lg-block">
                <div id="auth-left">
                    <div class="auth-logo">
                        {{-- <a href="index.html"><img src="/assets/admin/img/logodinas.png" alt="Logo"></a> --}}
                    </div>
                    <h1 class="auth-title">Masuk</h1>
                    <p class="auth-subtitle mb-5">Selamat Datang di Platform Pelatihan Dinas Perpustakaan dan Kearsipan
                        Kabupaten Madiun</p>

                </div>
            </div>
            <div class="col-lg-7 col-7">
                <div id="auth-left">
                    @if (session()->has('login_error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            {{ session('login_error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
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
                        <button class="btn btn-primary btn-block btn-lg shadow-lg">Log in</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="text-gray-600">Belum memiliki akun? <a href="auth-register.html"
                                class="font-bold">Register</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Lupa password?</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/login/js/bootstrap.js"></script>
    <script src="assets/login/js/app.js"></script>
    <script src="/assets/login/extensions/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: '/login/reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
</body>

</html>
