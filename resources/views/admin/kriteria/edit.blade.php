@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Kriteria {{ $kriteria->nama_kriteria }}</h4>

                    <form action="/kriteria/{{ $kriteria->id }}/update" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kriteria</label>
                                    <input type="text" class="form-control" placeholder="First name"
                                        value="{{ $kriteria->nama_kriteria }}" required name="nama_kriteria">
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary" style="width: 100px" type="submit">Simpan</button>
                        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
