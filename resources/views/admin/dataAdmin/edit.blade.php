@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Admin</h2>
                            <h5 class="text-white op-7 mb-2">Data Admin</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/admin" class="btn btn-white btn-border btn-round mr-2"><i
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
                                <h4 class="card-title">Edit Data Admin</h4>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form method="post" action="/admin/admin/{{ $admin->id }}" class="mb-5"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group form-floating-label">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text"
                                        class="form-control input-solid @error('name') is-invalid @enderror" id="name"
                                        name="name" required autofocus value="{{ old('name', $admin->name) }}">
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
                                        value="{{ old('username', $admin->users->username) }}">
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
                                        name="email" required value="{{ old('email', $admin->users->email) }}">
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
                                    <small style="color:red">*kosongkan apabila tidak ingin mengubah password</small>
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
                                        value="{{ old('address', $admin->address) }}">
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
                                        name="age" required value="{{ old('age', $admin->age) }}" maxlength="3">
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
                                        name="no_hp" required value="{{ old('no_hp', $admin->no_hp) }}" maxlength="13">
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="no_member" class="form-label">No.Anggota Perpustakaan</label>
                                    <input type="text"
                                        class="form-control input-solid @error('no_member') is-invalid @enderror"
                                        id="no_member" name="no_member" required
                                        value="{{ old('no_member', $admin->no_member) }}"
                                        placeholder="No.Anggota Perpustakaan" maxlength="13">
                                    @error('no_member')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="profession" class="form-label">Pekerjaan</label>
                                    <input type="text"
                                        class="form-control input-solid @error('profession') is-invalid @enderror"
                                        id="profession" name="profession" required
                                        value="{{ old('profession', $admin->profession) }}" placeholder="Pekerjaan"
                                        maxlength="255">
                                    @error('profession')
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
                                        <option value="Laki-Laki" @if (old('gender', $admin->gender) == 'Laki-laki') selected @endif>
                                            Laki-Laki</option>
                                        <option value="Perempuan" @if (old('gender', $admin->gender) == 'Perempuan') selected @endif>
                                            Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="profession" class="form-label">Pekerjaan</label>
                                    <input type="text"
                                        class="form-control input-solid @error('profession') is-invalid @enderror"
                                        id="profession" name="profession" required
                                        value="{{ old('profession', $admin->profession) }}" placeholder="Pekerjaan">
                                    @error('profession')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="no_member" class="form-label">No.Anggota Perpustakaan</label>
                                    <input type="text"
                                        class="form-control input-solid @error('no_member') is-invalid @enderror"
                                        id="no_member" name="no_member" required
                                        value="{{ old('no_member', $admin->no_member) }}"
                                        placeholder="No. Anggota Perpustakaan">
                                    @error('no_member')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="image" class="form-label">Foto Profile admin</label>
                                    <input type="hidden" name="oldImage" value="{{ $admin->image }}">

                                    @if ($admin->image)
                                        <img src="{{ asset('storage/' . $admin->image) }}"
                                            class="img-preview img-fluid mb-3 col-sm-5 d-block"
                                            style="max-height:300px; overflow:hidden;">
                                    @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5"
                                            style="max-height:300px; overflow:hidden;">
                                    @endif
                                    <input class="form-control input-solid @error('image') is-invalid @enderror "
                                        type="file" id="image" name="image" onchange="previewImage()">
                                    <small style="color:red">*max.2MB</small> <br>
                                    <small style="color:red">*format png, jpg, dan jpeg</small>
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
            @include('admin.layouts.partials.footer')
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
