@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Sertifikat Pelatihan</h2>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/participant/training" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="far fa-arrow-alt-circle-left"></i> Kembali</a>
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
                                        <th>URL Sertifikat</th>
                                        <th>:</th>
                                        <td>
                                            @if ($typeTraining->certificates->link == null)
                                                <button class="btn btn-primary float-right text-white">Link Sertifikat Belum
                                                    di Upload</button>
                                            @else
                                                <a href="{{ $typeTraining->certificates->link }}" target="_blank"
                                                    style="color:black"> {{ $typeTraining->certificates->link }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <th>:</th>
                                        <td>
                                            @if ($typeTraining->certificates->desc == null)
                                                <button class="btn btn-primary float-right text-white">Tidak ada
                                                    Deskripsi</button>
                                            @else
                                                {!! $typeTraining->certificates->desc !!}
                                        </td>
                                        @endif
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('participants.layouts.partials.footer')
    </div>
@endsection
