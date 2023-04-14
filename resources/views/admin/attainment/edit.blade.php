@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Hasil Karya</h2>
                            <h5 class="text-white op-7 mb-2">Data Hasil Karya</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/attainment" class="btn btn-white btn-border btn-round mr-2"><i
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
                                <h4 class="card-title">Edit Data Hasil Karya</h4>
                            </div>
                        </div>
                        {{-- <div class="col-lg-8">
                            <form method="post" action="/admin/attainment/{{ $attainment->id }}" class="mb-5"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group form-floating-label">
                                    <label for="training" class="form-label">Jenis Pelatihan</label>
                                    <select class="form-control input-solid" name="type_training_id">
                                        @foreach ($type_trainings as $type_training)
                                            @if (old('type_training_id', $attainment->type_training_id) == $type_training->id)
                                                <option value="{{ $type_training->id }}" selected>{{ $type_training->name }}
                                                </option>
                                            @else
                                                <option value="{{ $type_training->id }}">{{ $type_training->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="id_user" class="form-label">Peserta</label>
                                    <select class="form-control input-solid" name="id_user">
                                        @foreach ($users as $user)
                                            @if (old('id_user', $attainment->id_user) == $user->id)
                                                <option value="{{ $user->id }}" selected>{{ $user->name }}
                                                </option>
                                            @else
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="comment" class="form-label">Ulasan</label>
                                    <input type="text"
                                        class="form-control input-solid @error('comment') is-invalid @enderror"
                                        id="comment" name="comment" required
                                        value="{{ old('comment', $attainment->comment) }}">
                                    @error('comment')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="image" class="form-label">Hasil Karya Pelatihan</label>
                                    <input type="hidden" name="oldImage" value="{{ $attainment->image }}">
                                    @if ($attainment->image)
                                        <img src="{{ asset('storage/' . $attainment->image) }}"
                                            class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                    @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                    @endif
                                    <input class="form-control input-solid @error('image') is-invalid @enderror "
                                        type="file" id="image" name="image" onchange="previewImage()">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="desc" class="form-label ">Rangkuman Pelatihan</label>
                                    @error('desc')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="desc" type="hidden" name="desc"
                                        value="{{ old('desc', $attainment->desc) }}">
                                    <trix-editor input="desc"></trix-editor>
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="value" class="form-label">Nilai Hasil Karya</label>
                                    <input type="text"
                                        class="form-control input-solid @error('value') is-invalid @enderror" id="value"
                                        name="value" value="{{ old('value', $attainment->value) }}"
                                        placeholder="Masukkan Nilai Hasil Karya" required>
                                    <small style="color:red">*Dinilai oleh Mentor</small>
                                    @error('value')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Edit data</button>
                            </form>
                        </div> --}}
                        <div class="tab-content bd bd-gray-100 bd-t-0 pd-20" id="myTabContent">
                            <div class="tab-pane fade show active" id="detail" role="tabpanel"
                                aria-labelledby="detail-tab">
                                <div class="card border-0 bg-white-9 rounded-xl p-0 mb-3">
                                    <form method="post" action="/admin/attainment/{{ $attainment->id }}" class="mb-5"
                                        enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hover">
                                                    <tr>
                                                        <th>Jenis Pelatihan</th>
                                                        <th>:</th>
                                                        <td> {{ $attainment->type_trainings->name ?? 'none' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Peserta</th>
                                                        <th>:</th>
                                                        <td> {{ $attainment->users->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Ulasan</th>
                                                        <th>:</th>
                                                        <td> {{ $attainment->comment }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasil Karya Pelatihan</th>
                                                        <th>:</th>
                                                        <td>
                                                            @if ($attainment->image)
                                                                <img src="{{ asset('storage/' . $attainment->image) }}"
                                                                    class="img-fluid mt-3"
                                                                    style="max-height:250px; overflow:hidden;">
                                                            @else
                                                                <button type="button" class="btn btn-danger btn-sm">Hasil
                                                                    Karya
                                                                    belum
                                                                    diupload</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Rangkuman Pelatihan</th>
                                                        <th>:</th>
                                                        <td> {{ $attainment->desc }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nilai Hasil Karya</th>
                                                        <th>:</th>
                                                        <td>
                                                            @if ($attainment->value == null)
                                                                <div class="form-group form-floating-label">
                                                                    <input type="text"
                                                                        class="form-control input-solid @error('value') is-invalid @enderror"
                                                                        id="value" name="value"
                                                                        value="{{ old('value', $attainment->value) }}"
                                                                        placeholder="Masukkan Nilai Hasil Karya" required>
                                                                    <small style="color:red">*Dinilai oleh Mentor</small>
                                                                    @error('value')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            @else
                                                                {{ $attainment->value }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Publikasi</th>
                                                        <th>:</th>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="nopublikasi" name="status"
                                                                        value="0" class="custom-control-input" required
                                                                        {{ $attainment->is_active == '0' ? 'checked' : '' }}>
                                                                    <label class="custom-control-label"
                                                                        for="nopublikasi">Tidak
                                                                        Publikasi</label><br>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="publikasi" name="status"
                                                                        value="1" class="custom-control-input" required
                                                                        {{ $attainment->is_active == '1' ? 'checked' : '' }}>
                                                                    <label class="custom-control-label"
                                                                        for="publikasi">Publikasi</label>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Edit
                                                                    data</button>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
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
    @endsection
