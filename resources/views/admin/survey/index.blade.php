@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Survey Rekomendasi Pelatihan</h2>
                            <h5 class="text-white op-7 mb-2">Data Survey Rekomendasi Pelatihan</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            {{-- <a href="/admin/survey/create" class="btn btn-white btn-border btn-round mr-2"><i
                                    class="fas fa-plus"></i> Tambah</a> --}}
                            {{-- <a href="#" class="btn btn-secondary btn-round"><i class="fas fa-print"></i> Cetak</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Tabel Data Survey Rekomendasi Pelatihan</h4>
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success col-lg-8" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive table-hover">
                                        <table id="table" class="table table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Usia</th>
                                                    <th>Alamat</th>
                                                    <th>Pekerjaan</th>
                                                    <th>Jumlah Kuota</th>
                                                    <th>Rekomendasi Pelatihan</th>
                                                    <th>Bulan Pelaksanaan</th>
                                                    {{-- <th>Deskripsi</th> --}}
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($surveys as $s)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $s->name }}</td>
                                                        <td>{{ $s->link }}</td>
                                                        <td>{{ $c->desc }}</td>
                                                        <td>
                                                            <div class="action-button mx-auto text-end">
                                                                <a href="/admin/survey/{{ $s->id }}/edit"
                                                                    class="badge btn-warning"><i class="far fa-edit""></i>
                                                                    Edit</a>
                                                                <form action="/admin/survey/{{ $s->id }}"
                                                                    method="post" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button class="badge btn-danger border-0"
                                                                        onclick="return confirm('Are you sure?')"><i
                                                                            class="fas fa-trash"></i> Hapus</button>
                                                                </form>
                                                                <a href="/admin/survey/{{ $s->id }}"
                                                                    class="badge btn-success"><i class="far fa-eye"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.partials.footer')
    </div>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/admin/survey/datasurvey',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'profession',
                        name: 'profession'
                    },
                    {
                        data: 'quota',
                        name: 'quota'
                    },
                    {
                        data: 'type_training',
                        name: 'type_training'
                    },
                    {
                        data: 'month',
                        name: 'month'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        });
    </script>
@endsection
