@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Atribut Penilaian {{ $atribut_penilaian->nama_atribut }}</h4>

                    <form action="/atribut_penilaian/{{ $atribut_penilaian->id }}/update" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Atribut</label>
                                    <input type="text" class="form-control" placeholder="Nama Atribut"
                                        value="{{ $atribut_penilaian->nama_atribut }}" required name="nama_atribut">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Bobot</label>
                                    <input type="number" class="form-control" placeholder="Contoh 0"
                                        value="{{ $atribut_penilaian->bobot }}" required name="bobot">
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary" style="width: 100px" type="submit">Simpan</button>
                        <a href="{{ route('atribut_penilaian.index', $atribut_penilaian->kriteria_id) }}"
                            class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
