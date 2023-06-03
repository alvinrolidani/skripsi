@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Posisi {{ $posisi->nama_posisi }}</h4>

                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Posisi</label>
                                <input type="text" class="form-control" placeholder="First nama_posisi"
                                    value="{{ $posisi->nama_posisi }}" disabled name="name">
                            </div>
                        </div>

                    </div>



                    <a href="{{ route('position.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
