@extends('admin.layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Mentor</h2>
                            <h5 class="text-white op-7 mb-2">Data Mentor</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="/admin/mentor" class="btn btn-white btn-border btn-round mr-2"><i
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
                                        <th>Nama</th>
                                        <th>:</th>
                                        <td> {{ $mentor->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <th>:</th>
                                        <td> {{ $mentor->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>:</th>
                                        <td> {{ $mentor->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <th>:</th>
                                        <td> {{ $mentor->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usia</th>
                                        <th>:</th>
                                        <td> {{ $mentor->users->age }}</td>
                                    </tr>
                                    <tr>
                                        <th>No.HP</th>
                                        <th>:</th>
                                        <td> {{ $mentor->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <th>:</th>
                                        <td> {{ $mentor->users->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <th>:</th>
                                        <td> {{ $mentor->users->profession }}</td>
                                    </tr>
                                    <tr>
                                        <th>No.Anggota Perpustakaan</th>
                                        <th>:</th>
                                        <td> {{ $mentor->users->no_member }}</td>
                                    </tr>
                                    <tr>
                                        <th>Foto Profile Mentor</th>
                                        <th>:</th>
                                        <td>
                                            @if ($mentor->users->image)
                                                <img src="{{ asset('storage/' . $mentor->users->image) }}"
                                                    class="img-fluid mt-3" style="max-height:250px; overflow:hidden;">
                                            @else
                                                <button type="button" class="btn btn-danger btn-sm">Foto Profile belum di
                                                    upload</button>
                                            @endif

                                        </td>
                                    </tr>
                                </table>
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
