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
            <form method="POST" action="{{ route('update.user.profile') }}" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row gutters">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="account-settings">
                                        <div class="user-profile">

                                            <div class="user-avatar">
                                                <input type="hidden" name="oldImage" value="">
                                                @if (auth()->user()->levels->name == 'Admin')
                                                    @if (auth()->user()->admins->image == null)
                                                        <img src="/assets/admin/img/profiledefault.png" alt="..."
                                                            class="img-preview rounded-circle" style=" object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('storage/' . auth()->user()->admins->image) }}"
                                                            alt="..." class="img-preview rounded-circle"
                                                            style=" object-fit: cover;">
                                                    @endif
                                                @elseif (auth()->user()->levels->name == 'Mentor')
                                                    @if (auth()->user()->mentors->image == null)
                                                        <img src="/assets/admin/img/profiledefault.png" alt="..."
                                                            class="img-preview rounded-circle" style=" object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('storage/' . auth()->user()->mentors->image) }}"
                                                            alt="..." class="img-preview rounded-circle"
                                                            style=" object-fit: cover;">
                                                    @endif
                                                @endif
                                            </div>
                                            <h5 class="user-name">{{ auth()->user()->name }}</h5>
                                            <h6 class="user-email">{{ auth()->user()->email }}</h6>
                                            <br>
                                            <div class="media-body ml-4">
                                                <input type="hidden" name="oldImage" value="">
                                                <label class="btn btn-outline-warning">
                                                    Upload new photo
                                                    <input type="file" class="account-settings-fileinput" name="image"
                                                        id="image" onchange="previewImage()">
                                                </label> &nbsp;
                                                <small style="color:red">*ukuran foto max.2MB</small> <br>
                                                <small style="color:red">*format png, jpg, dan jpeg</small>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <h6 class="mb-2 text-primary">Personal Details</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Nama Lengkap</label>
                                                <input type="text" class="form-control input-solid" name="name"
                                                    placeholder="Masukkan Nama Lengkap"
                                                    @if (auth()->user()->levels->name == 'Mentor') value="{{ $user->mentors['name'] }}"
                                                    @elseif (auth()->user()->levels->name == 'Admin')
                                                    value="{{ $user->admins['name'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control input-solid" name="email"
                                                    placeholder="Masukkan Email"
                                                    @if (auth()->user()->levels->name == 'Mentor') value="{{ $user['email'] }}"
                                                    @elseif (auth()->user()->levels->name == 'Admin')
                                                    value="{{ $user['email'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control input-solid" name="username"
                                                    placeholder="Masukkan Username"
                                                    @if (auth()->user()->levels->name == 'Mentor') value="{{ $user['username'] }}"
                                                    @else
                                                    value="{{ $user['username'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control input-solid" name="password"
                                                    placeholder="Masukkan Password">
                                                <small style="color:red">*kosongkan apabila tidak ingin mengubah
                                                    password</small>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="no_hp">No.HP</label>
                                                <input type="text" class="form-control input-solid" name="no_hp"
                                                    placeholder="Masukkan No.HP"
                                                    @if (auth()->user()->levels->name == 'Mentor') value="{{ $user->mentors['no_hp'] }}"
                                                    @elseif (auth()->user()->levels->name == 'Admin')
                                                    value="{{ $user->admins['no_hp'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="no_member">No.Anggota Perpustakaan</label>
                                                <input type="text" class="form-control input-solid" name="no_member"
                                                    placeholder="Masukkan No.Anggota Perpustakaan"
                                                    @if (auth()->user()->levels->name == 'Mentor') value="{{ $user->mentors['no_member'] }}"
                                                    @elseif (auth()->user()->levels->name == 'Admin')
                                                    value="{{ $user->admins['no_member'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="gender">Jenis Kelamin</label>
                                                <select
                                                    class="form-control input-solid @error('gender') is-invalid @enderror"
                                                    id="gender" required name="gender">
                                                    <option selected disabled value="">Silahkan dipilih...</option>
                                                    @if (auth()->user()->levels->name == 'Mentor')
                                                        <option value="Laki-Laki"
                                                            @if (old('gender', $user->mentors['gender']) == 'Laki-laki') selected @endif>
                                                            Laki-Laki</option>
                                                        <option value="Perempuan"
                                                            @if (old('gender', $user->mentors['gender']) == 'Perempuan') selected @endif>
                                                            Perempuan</option>
                                                    @else
                                                        <option value="Laki-Laki"
                                                            @if (old('gender', $user->admins['gender']) == 'Laki-laki') selected @endif>
                                                            Laki-Laki</option>
                                                        <option value="Perempuan"
                                                            @if (old('gender', $user->admins['gender']) == 'Perempuan') selected @endif>
                                                            Perempuan</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="profession">Pekerjaan</label>
                                                <input type="text" class="form-control input-solid" name="profession"
                                                    placeholder="Masukkan Pekerjaan"
                                                    @if (auth()->user()->levels->name == 'Mentor') value="{{ $user->mentors['profession'] }}"
                                                    @elseif (auth()->user()->levels->name == 'Admin')
                                                    value="{{ $user->admins['profession'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="age">Umur</label>
                                                <input type="text" class="form-control input-solid" name="age"
                                                    placeholder="Masukkan Umur"
                                                    @if (auth()->user()->levels->name == 'Mentor') value="{{ $user->mentors['age'] }}"
                                                    @elseif (auth()->user()->levels->name == 'Admin')
                                                    value="{{ $user->admins['age'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="address">Alamat</label>
                                                <input type="text" class="form-control input-solid" name="address"
                                                    placeholder="Masukkan Alamat"
                                                    @if (auth()->user()->levels->name == 'Mentor') value="{{ $user->mentors['address'] }}"
                                                    @elseif (auth()->user()->levels->name == 'Admin')
                                                    value="{{ $user->admins['address'] }}" @endif>
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
            </form>
        </div>
        @include('admin.layouts.partials.footer')
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
