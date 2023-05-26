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

            <form method="POST" action="/participant/comment/create/{{ $typeTraining->id }}" class="mb-5"
                enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-9 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row gutters">
                                        @if (session()->has('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mb-2 text-primary">Tambah Komentar</h6>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label for="comment">Komentar</label>
                                            <textarea type="text" class="form-control input-solid @error('comment') is-invalid @enderror" name="comment"
                                                placeholder="Berikan komentar Anda" required></textarea>
                                            @error('comment')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row gutters">
                                        <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12  float-right">
                                            <div class="text-right">
                                                <button type="submit"
                                                    class="btn btn-primary btn-lg btn-block text-white ">Kirim</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @include('participants.layouts.partials.footer')
    </div>
@endsection
