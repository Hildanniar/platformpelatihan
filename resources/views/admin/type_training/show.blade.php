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
                                    class="far fa-arrow-alt-circle-left"></i></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content bd bd-gray-100 bd-t-0 pd-20" id="myTabContent">
                <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                    <div class="card border-0 bg-white-9 rounded-xl p-0 mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <tr>
                                        <th>Nama Pelatihan</th>
                                        <th>:</th>
                                        <td> {{ $type_training->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kuota Pelatihan</th>
                                        <th>:</th>
                                        <td> {{ $type_training->quota }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gambar Pelatihan</th>
                                        <th>:</th>
                                        <td>
                                            @if ($type_training->image)
                                                <img src="{{ asset('storage/' . $type_training->image) }}"
                                                    class="img-fluid mt-3" style="max-height:250px; overflow:hidden;">
                                            @else
                                                <button type="button" class="btn btn-danger btn-sm">Gambar Pelatihan belum
                                                    di upload</button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi Pelatihan</th>
                                        <th>:</th>
                                        <td> {!! $type_training->desc !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layouts.partials.footer')
        </div>
    @endsection
