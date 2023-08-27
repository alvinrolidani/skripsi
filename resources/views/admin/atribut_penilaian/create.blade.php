@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Atribut Penilaian</h4>

                    <form action="{{ route('atribut_penilaian.store', $id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kriteria</label>
                                    <input type="text" class="form-control" placeholder="Nama Kriteria"
                                        value="{{ $kriteria->nama_kriteria }}" readonly name="kriteria_id">
                                </div>
                                <div class="mb-3">

                                    <label class="form-label">Nama Atribut Penilaian</label>
                                    <input type="text" class="form-control" placeholder="Nama Atribut" value=""
                                        required name="nama_atribut">
                                </div>
                                <div class="mb-3">

                                    <label class="form-label">Bobot Atribut Penilaian</label>

                                    <input type="number" class="form-control" placeholder="Bobot" value="" required
                                        name="bobot">
                                </div>


                            </div>


                        </div>

                        <button class="btn btn-primary" style="width: 100px" type="submit">Simpan</button>
                        <a @if (!array_key_exists($kriteria->id, $hitung)) href="{{ route('kriteria.index') }}"@else
                            href="{{ route('atribut_penilaian.index', $id) }}" @endif
                            class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
