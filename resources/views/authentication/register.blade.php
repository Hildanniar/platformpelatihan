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
        <h1 class="text-white">REGISTER USER</h1>
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
                    <br>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('actionregister') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label><i class="fa fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                required="">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-user"></i> Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username"
                                required="">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-key"></i> Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                required="">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-address-book"></i> Role</label>
                            <select class="form-control" name="type_training_id" required>
                                <option selected disabled value="">Silahkan dipilih</option>
                                @foreach ($levels as $level)
                                    @if (old('level_id') == $level->id)
                                        <option value="{{ $level->id }}" selected>{{ $level->name }}
                                        </option>
                                    @else
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="text-gray-600">Sudah memiliki akun? <a href="/login" class="font-bold">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->
