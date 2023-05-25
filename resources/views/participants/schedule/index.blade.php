@extends('participants.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Jadwal Pelatihan</h2>
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
                                @foreach ($typeTraining->schedules as $s)
                                    <table class="table table-sm table-hover">
                                        <tr>
                                            <th>Tanggal Mulai</th>
                                            <th>:</th>
                                            <td> {{ $s->start_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Akhir</th>
                                            <th>:</th>
                                            <td> {{ $s->end_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jam Mulai</th>
                                            <th>:</th>
                                            <td> {{ $s->start_time }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jam Akhir</th>
                                            <th>:</th>
                                            <td> {{ $s->end_time }}</td>
                                        </tr>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('participants.layouts.partials.footer')
    </div>
@endsection
