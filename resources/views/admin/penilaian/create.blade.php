@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Penilaian</h4>

                    <form action="{{ route('penilaian.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Nama Toko</label>
                                <select name="alternatif_id" class="selectpicker form-select" required>
                                    <option value="" disabled selected>Pilih Toko</option>
                                    @foreach ($alternatif as $item)
                                        <option value="{{ $item->id }}"
                                            @if (array_key_exists($item->id, $resulthitung)) disabled @endif>
                                            {{ $item->nama_toko }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tahun Awal Penilaian</label>
                                    <input type="text" class="form-control" id="datepicker" placeholder="dd-mm-yyyy"
                                        name="tahun_awal" value="{{ $tAwal }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Tahun Akhir Penilaian</label>
                                    <input type="text" class=" form-control" id="datepicker1" placeholder="dd-mm-yyyy"
                                        name="tahun_akhir" value="{{ $tAkhir }}" readonly>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h4 class="card-title mb-5">Form Nilai Setiap Kriteria</h4>
                            </div>
                            @foreach ($kriteria as $item => $key)
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="">{{ $key->nama_kriteria }}</label>
                                        @if (array_key_exists($key->id, $hitung))
                                            <select name="kriteria[{{ $key->id }}]" id="" class="form-select"
                                                required>
                                                <option value="" disabled selected>--Pilih--</option>
                                                @foreach ($key->atribut_penilaian as $item1 => $value)
                                                    <option value="{{ $value->bobot }}">{{ $value->nama_atribut }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="number" class="form-control" name="kriteria[{{ $key->id }}]"
                                                required min="0">
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <button class="btn btn-primary" style="width: 100px" type="submit">Simpan</button>
                        <a href="/penilaian?tahun_awal={{ $tAwal . '&tahun_akhir=' . $tAkhir }}"
                            class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
