@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Profile</h2>
                            <h5 class="text-white op-7 mb-2">Admin Profile</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                            <input type="hidden" name="oldImage" value="{{ auth()->user()->image }}">
                                            @if (auth()->user()->image == null)
                                                <img src="/assets/admin/img/profiledefault.png" alt="..."
                                                    class="img-preview rounded-circle">
                                            @else
                                                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="..."
                                                    class="img-preview rounded-circle">
                                            @endif
                                        </div>
                                        <h5 class="user-name">{{ auth()->user()->name }}</h5>
                                        <h6 class="user-email">{{ auth()->user()->email }}</h6>
                                        <br>
                                        <div class="media-body ml-4">
                                            <label class="btn btn-outline-warning">
                                                Upload new photo
                                                <input type="file" class="account-settings-fileinput" name="image"
                                                    id="image" onchange="previewImage()">
                                            </label> &nbsp;
                                            <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 3MB
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <form method="POST" action="{{ route('update.user.profile') }}" class="mb-5"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row gutters">
                                        @if (session()->has('success'))
                                            <div class="alert alert-success col-lg-8" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mb-2 text-primary">Personal Details</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Nama Lengkap</label>
                                                <input type="text" class="form-control input-solid" name="name"
                                                    placeholder="Masukkan Nama Lengkap" value="{{ $user['name'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control input-solid" name="email"
                                                    placeholder="Masukkan Email" value="{{ $user['email'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control input-solid" name="username"
                                                    placeholder="Masukkan Username" value="{{ $user['username'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control input-solid" name="password"
                                                    placeholder="Masukkan Password">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="no_hp">No.HP</label>
                                                <input type="text" class="form-control input-solid" name="no_hp"
                                                    placeholder="Masukkan No.HP" value="{{ $user['no_hp'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="no_member">No.Anggota Perpustakaan</label>
                                                <input type="text" class="form-control input-solid" name="no_member"
                                                    placeholder="Masukkan No.Anggota Perpustakaan"
                                                    value="{{ $user['no_member'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="gender">Jenis Kelamin</label>
                                                <select
                                                    class="form-control input-solid @error('gender') is-invalid @enderror"
                                                    id="gender" required name="gender">
                                                    <option selected disabled value="">Silahkan dipilih...</option>
                                                    <option value="Laki-Laki"
                                                        @if (old('gender', $user['gender']) == 'Laki-laki') selected @endif>
                                                        Laki-Laki</option>
                                                    <option value="Perempuan"
                                                        @if (old('gender', $user['gender']) == 'Perempuan') selected @endif>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="profession">Pekerjaan</label>
                                                <input type="text" class="form-control input-solid" name="profession"
                                                    placeholder="Masukkan Pekerjaan" value="{{ $user['profession'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="age">Umur</label>
                                                <input type="text" class="form-control input-solid" name="age"
                                                    placeholder="Masukkan Umur" value="{{ $user['age'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="address">Alamat</label>
                                                <input type="text" class="form-control input-solid" name="address"
                                                    placeholder="Masukkan Alamat" value="{{ $user['address'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Dinas Perpustakaan dan Kearsipan Kabupaten Madiun
                            </a>
                        </li>
                </nav>
                <div class="copyright ml-auto">
                    Copyright
                </div>
            </div>
        </footer>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
