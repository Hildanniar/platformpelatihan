@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Hasil Karya Pelatihan</h2>
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
                                            <input type="hidden" name="oldImage" value="">
                                            @if (auth()->user()->levels->name == 'Peserta')
                                                @if (auth()->user()->participants->image == null)
                                                    <img src="/assets/admin/img/profiledefault.png" alt="..."
                                                        class="img-preview rounded-circle" style=" object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('storage/' . auth()->user()->participants->image) }}"
                                                        alt="..." class="img-preview rounded-circle"
                                                        style=" object-fit: cover;">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body ml-4">
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
                        <div class="card h-90 w-75">
                            <div class="card-body">
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
                                            <label for="email">URL Project</label>
                                            <input type="email" class="form-control input-solid" name="email"
                                                placeholder="URL Project" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Deskripsi Project</label>
                                            <textarea type="text" class="form-control input-solid" name="name" placeholder="Deskripsi Project" value=""></textarea>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="name">Komentar</label>
                                            <textarea type="text" class="form-control input-solid" name="name" placeholder="Deskripsi Project" value=""></textarea>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('participants.layouts.partials.footer')
    </div>
@endsection
