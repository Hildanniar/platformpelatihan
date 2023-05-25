@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">

                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            {{-- <h2 class="text-white pb-2 fw-bold">{{ $typeTraining->name }}</h2> --}}
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
                                        <th>Bagi Peserta yang memilih Kelas Offline, maka diharapkan untuk datang ke</th>
                                        <th>:</th>
                                        <td><a href="https://goo.gl/maps/J5M7W7PxtxGLUNhx8" target="_blank"
                                                style="color:black"> Jalan Bali No. 3, Krajan, Mejayan
                                                Caruban, Caruban, Krajan, Kec. Madiun,
                                                Kabupaten Madiun, Jawa Timur 63153</a> </td>
                                    </tr>
                                    <tr>
                                        <th>Jika ingin mengupload hasil karya silahkan klik tombol disamping</th>
                                        <th>:</th>
                                        <th><a href="/participant/attainments/{{ $typeTraining->id }}"
                                                class="btn btn-warning btn-sm"><i class="far fa-file"></i>
                                                Upload Hasil Karya</a></th>
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
