@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Atribut Penilaian {{ $atribut_penilaian->nama_crips }}</h4>

                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Kriteria</label>
                                <input type="text" class="form-control" placeholder="Nama Kriteria"
                                    value="{{ $atribut_penilaian->kriteria->nama_kriteria }}" disabled name="nama_kriteria">
                            </div>
                            <div class="mb-3">

                                <label class="form-label">Nama Atribut</label>
                                <input type="text" class="form-control" placeholder="Nama Crips"
                                    value="{{ $atribut_penilaian->nama_crips }}" disabled name="nama_crips">
                            </div>
                            <div class="mb-3">

                                <label class="form-label">Bobot Crips</label>
                                <input type="number" class="form-control" placeholder="Bobot"
                                    value="{{ $atribut_penilaian->bobot }}" disabled name="bobot">
                            </div>
                        </div>

                    </div>



                    <a href="{{ route('atribut_penilaian.index', $crips->kriteria_id) }}"
                        class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
