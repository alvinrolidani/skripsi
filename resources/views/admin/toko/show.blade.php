@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Toko {{ $toko->nama_toko }}</h4>

                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Toko</label>
                                <input type="text" class="form-control" placeholder="Nama Toko"
                                    value="{{ $toko->nama_toko }}" disabled name="nama_toko">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lokasi Toko</label>
                                <input type="text" class="form-control" placeholder="Lokasi Toko"
                                    value="{{ ucwords($toko->lokasi_toko) }}" disabled name="nama_toko">
                            </div>
                        </div>

                    </div>



                    <a href="{{ route('toko.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
