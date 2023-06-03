@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Kriteria {{ $kriteria->nama_kriteria }}</h4>

                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Kriteria</label>
                                <input type="text" class="form-control" placeholder="Nama Kriteria"
                                    value="{{ $kriteria->nama_kriteria }}" disabled name="nama_kriteria">
                            </div>
                        </div>

                    </div>



                    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
