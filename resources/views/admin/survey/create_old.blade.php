@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Survey Pelatihan</h2>
                            <h5 class="text-white op-7 mb-2">Data Survey Pelatihan</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/survey" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="fa-sharp fa-regular fa-arrow-left"></i></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Tambah Data Survey Pelatihan</h4>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form method="post" action="/admin/survey" class="mb-5" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-floating-label">
                                    <label for="name" class="form-label">Judul Survey</label>
                                    <input type="text"
                                        class="form-control input-solid @error('name') is-invalid @enderror" id="name"
                                        name="name" required autofocus placeholder="Nama" value="{{ old('name') }}"">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="link" class="form-label">Link Survey</label>
                                    <input type="text"
                                        class="form-control input-solid @error('link') is-invalid @enderror" id="link"
                                        name="link" required placeholder="Link Sertifikat">
                                    @error('link')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="desc" class="form-label ">Deskripsi Survey</label>
                                    @error('desc')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="desc" type="hidden" name="desc" value="{{ old('desc') }}">
                                    <trix-editor input="desc"></trix-editor>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah data</button>
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
    @endsection
