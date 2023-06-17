@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Jadwal Pelatihan</h2>
                            <h5 class="text-white op-7 mb-2">Data Jadwal Pelatihan</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/schedule" class="btn btn-white btn-border btn-round mr-2"><i
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
                                <h4 class="card-title">Edit Data Jadwal Pelatihan</h4>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form method="post" action="/admin/schedule/{{ $schedule->id }}" class="mb-5"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group form-floating-label">
                                    <label for="training" class="form-label">Jenis Pelatihan</label>
                                    <select class="form-control input-solid" name="type_training_id">
                                        @foreach ($type_trainings as $type_training)
                                            @if (old('type_training_id', $schedule->type_training_id) == $type_training->id)
                                                <option value="{{ $type_training->id }}" selected>{{ $type_training->name }}
                                                    - Kelas {{ $type_training->class }}
                                                </option>
                                            @else
                                                <option value="{{ $type_training->id }}">{{ $type_training->name }} -
                                                    Kelas {{ $type_training->class }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date"
                                        class="form-control input-solid @error('start_date') is-invalid @enderror"
                                        id="start_date" name="start_date" required
                                        value="{{ old('start_date', $schedule->start_date) }}">
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
                                        value="{{ old('end_date', $schedule->end_date) }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="start_time" class="form-label">Jam Mulai</label>
                                    <input type="time"
                                        class="form-control input-solid @error('start_time') is-invalid @enderror"
                                        id="start_time" name="start_time" required
                                        value="{{ old('start_time', $schedule->start_time) }}">
                                    @error('start_time')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <label for="end_time" class="form-label">Jam Akhir</label>
                                    <input type="time"
                                        class="form-control input-solid @error('end_time') is-invalid @enderror"
                                        id="end_time" name="end_time" required
                                        value="{{ old('end_time', $schedule->end_time) }}">
                                    @error('end_time')
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
    @endsection
