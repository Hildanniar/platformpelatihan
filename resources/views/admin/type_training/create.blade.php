@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Jenis Pelatihan</h2>
                            <h5 class="text-white op-7 mb-2">Data Jenis Pelatihan</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/type_training" class="btn btn-white btn-border btn-round mr-2"><i
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
                                <h4 class="card-title">Tambah Data Jenis Pelatihan</h4>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form method="post" action="/admin/type_training" class="mb-5" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-floating-label">
                                    <label for="name" class="form-label">Nama Pelatihan</label>
                                    <input type="text"
                                        class="form-control input-solid @error('name') is-invalid @enderror" id="name"
                                        name="name" required autofocus placeholder="Nama" value="{{ old('name') }}"">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="class" class="form-label">Kelas</label>
                                    <select class="form-control input-solid @error('class') is-invalid @enderror"
                                        id="class" required name="class">
                                        <option selected disabled value="">Silahkan dipilih...</option>
                                        <option>Offline</option>
                                        <option>Online</option>
                                    </select>
                                    @error('class')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="quota" class="form-label">Kuota Pelatihan</label>
                                    <input type="text"
                                        class="form-control input-solid @error('quota') is-invalid @enderror" id="quota"
                                        name="quota" required value="{{ old('quota') }}"
                                        placeholder="Isi Kuota Pelatihan">
                                    @error('quota')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="image" class="form-label">Gambar Pelatihan</label>
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                    <input class="form-control input-solid @error('image') is-invalid @enderror "
                                        type="file" id="image" name="image" onchange="previewImage()">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="desc" class="form-label ">Dekripsi Pelatihan</label>
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
