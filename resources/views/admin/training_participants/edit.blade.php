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
                        <div class="tab-content bd bd-gray-100 bd-t-0 pd-20" id="myTabContent">
                            <div class="tab-pane fade show active" id="detail" role="tabpanel"
                                aria-labelledby="detail-tab">
                                <div class="card border-0 bg-white-9 rounded-xl p-0 mb-3">
                                    <form method="post"
                                        action="/admin/training_participants/{{ $training_participants->id }}"
                                        class="mb-5" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hover">
                                                    <tr>
                                                        <th>Jenis Pelatihan</th>
                                                        <th>:</th>
                                                        <td> {{ $training_participants->type_trainings->name ?? 'none' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Peserta</th>
                                                        <th>:</th>
                                                        <td> {{ $training_participants->participants->name ?? 'none' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Komentar Peserta</th>
                                                        <th>:</th>
                                                        <td>{{ $training_participants->comment }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Komentar Peserta</th>
                                                        <th>:</th>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="nopublikasi" name="status"
                                                                        value="NoPublikasi" class="custom-control-input"
                                                                        required
                                                                        {{ $training_participants->status == 'NoPublikasi' ? 'checked' : '' }}>
                                                                    <label class="custom-control-label"
                                                                        for="nopublikasi">Tidak
                                                                        Publikasi</label><br>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="publikasi" name="status"
                                                                        value="Publikasi" class="custom-control-input"
                                                                        required
                                                                        {{ $training_participants->status == 'Publikasi' ? 'checked' : '' }}>
                                                                    <label class="custom-control-label"
                                                                        for="publikasi">Publikasi</label>
                                                                </div>
                                                                <small style="color:red">*Silahkan dipilih salah
                                                                    satu</small>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Edit
                                                        data</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layouts.partials.footer')
        </div>
    @endsection
