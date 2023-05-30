@extends('participants.layouts.main')
@section('container')
    {{-- Modal Start
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Komentar</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ 'create.comment' }}">
                    @csrf

                    <input type="hidden" name="type_training_id" id="type_training_id" />

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Komentar</label>
                            <textarea class="form-control" id="comment" type="text" name="comment" placeholder="Berikan Komentar Anda"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    End Modal --}}

    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Jenis Pelatihan</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                {{-- <h4 class="card-title">Tabel Jenis Pelatihan</h4> --}}
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive table-hover">
                                        <table id="table" class="table table-hover table-responsive"
                                            style="table-layout: fixed; word-wrap: break-word;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis Pelatihan</th>
                                                    <th width="100px">Materi</th>
                                                    <th width="100px">Jadwal</th>
                                                    <th width="100px">Sertifikat</th>
                                                    <th width="100px">Komentar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <small style="color:red">*Tombol Materi warna Merah berarti anda mengikuti
                                            kelas online</small> <br>
                                        <small style="color:red">*Tombol Materi warna Kuning berarti anda mengikuti
                                            kelas offline</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('participants.layouts.partials.footer')
    </div>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/participant/training/datatraining",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'type_training_id',
                        name: 'jenis pelatihan'
                    },
                    {
                        data: 'materi',
                        name: 'materi'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'certificate',
                        name: 'certificate'
                    },
                    {
                        data: 'comment',
                        name: 'comment',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        });
    </script>
@endsection

{{-- @section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.editbtn', function() {
                var type_training_id = $(this).val();
                // alert(type_training_id);
                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/participant/comment/create/" + type_training_id,
                    data: "data",
                    dataType: "dataType",
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection --}}
