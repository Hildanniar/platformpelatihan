@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Peserta</h2>
                            <h5 class="text-white op-7 mb-2">Data Peserta</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/participant" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Edit Data Peserta</h4>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form method="post" action="/admin/participant/{{ $participant->id }}" class="mb-5"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group form-floating-label">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text"
                                        class="form-control input-solid @error('name') is-invalid @enderror" id="name"
                                        name="name" required autofocus placeholder="Nama"
                                        value="{{ old('name', $participant->name) }}">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text"
                                        class="form-control input-solid @error('username') is-invalid @enderror"
                                        id="username" name="username" required
                                        value="{{ old('username', $participant->users->username) }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email"
                                        class="form-control input-solid @error('email') is-invalid @enderror" id="email"
                                        name="email" required value="{{ old('email', $participant->email) }}"
                                        placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password"
                                        class="form-control input-solid @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text"
                                        class="form-control input-solid @error('address') is-invalid @enderror"
                                        id="address" name="address" required
                                        value="{{ old('address', $participant->address) }}" placeholder="Alamat">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="age" class="form-label">Usia</label>
                                    <input type="text"
                                        class="form-control input-solid @error('age') is-invalid @enderror" id="age"
                                        name="age" required value="{{ old('age', $participant->users->age) }}"
                                        maxlength="3">
                                    @error('age')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="no_hp" class="form-label">No.HP</label>
                                    <input type="text"
                                        class="form-control input-solid @error('no_hp') is-invalid @enderror" id="no_hp"
                                        name="no_hp" required value="{{ old('no_hp', $participant->no_hp) }}"
                                        placeholder="No.HP" maxlength="13">
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-group form-floating-label">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-control input-solid @error('gender') is-invalid @enderror"
                                        id="gender" required name="gender">
                                        <option selected disabled value="">Silahkan dipilih...</option>
                                        <option value="Laki-Laki" @if (old('gender', $participant->users->gender) == 'Laki-laki') selected @endif>
                                            Laki-Laki</option>
                                        <option value="Perempuan" @if (old('gender', $participant->users->gender) == 'Perempuan') selected @endif>
                                            Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="training" class="form-label">Jenis Pelatihan</label>
                                    <select class="form-control input-solid" name="type_training_id">
                                        @foreach ($type_trainings as $type_training)
                                            @if (old('type_training_id', $participant->type_training_id) == $type_training->id)
                                                <option value="{{ $type_training->id }}" selected>
                                                    {{ $type_training->name }}
                                                </option>
                                            @else
                                                <option value="{{ $type_training->id }}">{{ $type_training->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="class" class="form-label">Kelas</label>
                                    <select class="form-control input-solid @error('class') is-invalid @enderror"
                                        id="class" required name="class">
                                        <option selected disabled value="">Silahkan dipilih...</option>
                                        <option value="Offline" @if (old('class', $participant->class) == 'Offline') selected @endif>Offline
                                        </option>
                                        </option>
                                        <option value="Online" @if (old('class', $participant->class) == 'Online') selected @endif>Online
                                        </option>
                                    </select>
                                    @error('class')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="image" class="form-label">Foto Profile Peserta</label>
                                    <input type="hidden" name="oldImage" value="{{ $participant->users->image }}">
                                    @if ($participant->users->image)
                                        <img src="{{ asset('storage/' . $participant->users->image) }}"
                                            class="img-preview img-fluid mb-3 col-sm-5 d-block"
                                            style="max-height:300px; overflow:hidden;">
                                    @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5"
                                            style="max-height:300px; overflow:hidden;">
                                    @endif
                                    <input class="form-control input-solid @error('image') is-invalid @enderror "
                                        type="file" id="image" name="image" onchange="previewImage()">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Edit data</button>
                            </form>
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
