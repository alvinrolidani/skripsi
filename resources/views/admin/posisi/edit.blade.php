@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit posisi {{ $posisi->nama_posisi }}</h4>

                    <form action="/position/{{ $posisi->id }}/update" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama posisi</label>
                                    <input type="text" class="form-control" placeholder="First name"
                                        value="{{ $posisi->nama_posisi }}" required name="nama_posisi">
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary" style="width: 100px" type="submit">Simpan</button>
                        <a href="{{ route('position.index') }}" class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
