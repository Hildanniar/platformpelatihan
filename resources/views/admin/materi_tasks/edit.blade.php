@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Materi & Tugas</h2>
                            <h5 class="text-white op-7 mb-2">Data Materi & Tugas</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/materi_tasks" class="btn btn-white btn-border btn-round mr-2"><i
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
                                <h4 class="card-title">Edit Data Materi</h4>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form method="post" action="/admin/materi_tasks/{{ $materi_tasks->id }}" class="mb-5"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group form-floating-label">
                                    <label for="training" class="form-label">Jenis Pelatihan</label>
                                    <select class="form-control input-solid" name="type_training_id">
                                        @foreach ($type_trainings as $type_training)
                                            @if (old('type_training_id', $materi_tasks->type_training_id) == $type_training->id)
                                                <option value="{{ $type_training->id }}" selected>{{ $type_training->name }}
                                                </option>
                                            @else
                                                <option value="{{ $type_training->id }}">{{ $type_training->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-group form-floating-label">
                                    <label for="bab_materi" class="form-label">Bab Materi</label>
                                    <select class="form-control input-solid @error('bab_materi') is-invalid @enderror"
                                        id="bab_materi" required name="bab_materi">
                                        <option selected disabled value="">Silahkan dipilih...</option>
                                        <option value="BAB I" @if (old('bab_materi', $materi_tasks->bab_materi) == 'BAB I') selected @endif>
                                            BAB I</option>
                                        <option value="BAB II" @if (old('bab_materi', $materi_tasks->bab_materi) == 'BAB II') selected @endif>
                                            BAB II</option>
                                        <option value="BAB III" @if (old('bab_materi', $materi_tasks->bab_materi) == 'BAB III') selected @endif>
                                            BAB III</option>
                                    </select>
                                    @error('bab_materi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">File Materi</label>
                                    <input type="hidden" name="oldFile" value="{{ $materi_tasks->file_materi }}">
                                    @if ($materi_tasks->file_materi)
                                        <img src="{{ asset('storage/' . $materi_tasks->file_materi) }}"
                                            class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                    @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                    @endif
                                    <input class="form-control @error('file_materi') is-invalid @enderror " type="file"
                                        id="file_materi" name="file_materi" onchange="previewFile()">
                                    @error('file_materi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="body_materi" class="form-label">Teks Materi</label>
                                    @error('body_materi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="body_materi" type="hidden" name="body_materi"
                                        value="{{ old('body_materi', $materi_tasks->body_materi) }}">
                                    <trix-editor input="body_materi"></trix-editor>
                                </div>
                                <div class="card-header">
                                    <div class="card-head-row card-tools-still-right">
                                        <h4 class="card-title">Edit Data Tugas</h4>
                                    </div>
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="name_task" class="form-label">Nama Tugas</label>
                                    <input type="text"
                                        class="form-control input-solid @error('name_task') is-invalid @enderror"
                                        id="name_task" name="name_task" required
                                        value="{{ old('name_task', $materi_tasks->name_task) }}" maxlength="255">
                                    @error('name_task')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date"
                                        class="form-control input-solid @error('start_date') is-invalid @enderror"
                                        id="start_date" name="start_date" required
                                        value="{{ old('start_date', $materi_tasks->start_date) }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                                    <input type="date"
                                        class="form-control input-solid @error('end_date') is-invalid @enderror"
                                        id="end_date" name="end_date" required
                                        value="{{ old('end_date', $materi_tasks->end_date) }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="desc_task" class="form-label">Deskripsi Tugas</label>
                                    @error('desc_task')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="desc_task" type="hidden" name="desc_task"
                                        value="{{ old('desc_task', $materi_tasks->desc_task) }}">
                                    <trix-editor input="desc_task"></trix-editor>
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
    @endsection
