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
            <form method="post" action="/participant/attainment/create/{{ $typeTraining->id }}" class="mb-5"
                enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row gutters">
                        <div class=" col-lg-6  ">
                            <div class="card h-100 w-100">
                                <div class="card-body">
                                    <div class="account-settings">
                                        <div class="form-group form-floating-label">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h6 class="mb-2 text-primary">Foto Hasil Karya</h6>
                                            </div>
                                            <img class="img-preview img-fluid mb-3 col-sm-5"
                                                style="max-height:700px; max-width:700px; overflow:hidden;">
                                            <input class="form-control input-solid @error('image') is-invalid @enderror "
                                                type="file" id="image" name="image" onchange="previewImage()"
                                                required>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <small style="color:red">*max.3MB</small> <br>
                                            <small style="color:red">*format PNG, JPG, dan JPEG</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-6  ">
                            <div class="card h-100 w-100">
                                <div class="card-body">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success col-lg-8" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-2 text-primary">Form Hasil Karya</h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="materi_task_id" class="form-label">Materi Pelatihan</label>
                                        <select class="form-control input-solid" name="materi_task_id">
                                            <option selected disabled value="">Silahkan dipilih...</option>
                                            @foreach ($materi_tasks as $materi_task)
                                                @if (old('materi_task_id') == $materi_task->id)
                                                    <option value="{{ $materi_task->id }}" selected>
                                                        {{ $materi_task->name_materi }}
                                                    </option>
                                                @else
                                                    <option value="{{ $materi_task->id }}">{{ $materi_task->name_materi }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">URL Hasil Karya</label>
                                        <input type="link"
                                            class="form-control input-solid  @error('link') is-invalid @enderror"
                                            name="link" placeholder="URL Hasil Karya" value="" required>
                                        @error('link')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small style="color:red">*URL dapat berupa Google Drive, Github dan lainnya</small>
                                        <br>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Deskripsi Hasil Karya</label>
                                        <textarea type="text" class="form-control input-solid  @error('desc') is-invalid @enderror" name="desc"
                                            placeholder="Deskripsi Hasil Karya" value="" required></textarea>
                                        @error('desc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                            <label for="name">Komentar</label>
                                            <textarea type="text" class="form-control input-solid" name="name" placeholder="Deskripsi Project" value=""></textarea>
                                        </div> --}}

                                    <button type="submit" class="btn btn-primary float-right text-white">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @include('participants.layouts.partials.footer')
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
