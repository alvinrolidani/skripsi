@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Edit Penilaian</h4>

                    <form action="{{ route('penilaian.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Nama Toko</label>
                                <input type="hidden" value="{{ $result->alternatif_id }}" name="alternatif_id">
                                <input type="text" class="form-control" value="{{ $result->toko->nama_toko }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tahun Awal Penilaian</label>
                                    <input type="text" class="form-control" id="datepicker" placeholder="dd-mm-yyyy"
                                        name="tahun_awal" value="{{ $result->tahun_awal }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Tahun Akhir Penilaian</label>
                                    <input type="text" class=" form-control" id="datepicker1" placeholder="dd-mm-yyyy"
                                        name="tahun_akhir" value="{{ $result->tahun_akhir }}" readonly>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h4 class="card-title mb-5">Form Nilai Setiap Kriteria</h4>
                            </div>
                            @foreach ($penilaian as $item => $key)
                                <div class="col-md-3">
                                    <div class="mb-3">

                                        <label class="">{{ $key->nama_kriteria }}</label>

                                        @if (array_key_exists($key->id, $hitung))
                                            <select name="kriteria[{{ $key->id }}]" id="" class="form-select">
                                                @foreach ($key->penilaian as $item3 => $value2)
                                                    @foreach ($key->atribut_penilaian as $item2 => $value1)
                                                        <option {{ $value2->value == $value1->bobot ? 'selected' : '' }}
                                                            value="{{ $value1->bobot }}">
                                                            {{ $value1->nama_atribut }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        @else
                                            @foreach ($key->penilaian as $item3 => $value2)
                                                <input type="number" class="form-control" value="{{ $value2->value }}"
                                                    name="kriteria[{{ $key->id }}]" required min="0">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach


                            {{-- @foreach ($penilaian as $item => $key)
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        @foreach ($key->kriteria as $item1 => $value)
                                            <label class="">{{ $value->nama_kriteria }}</label>

                                            @if (array_key_exists($value->id, $hitung))
                                                <select name="kriteria[{{ $value->id }}]" id=""
                                                    class="form-select">
                                                    @foreach ($value->atribut_penilaian as $item2 => $value1)
                                                        <option {{ $key->value == $value1->bobot ? 'selected' : '' }}
                                                            value="{{ $value1->bobot }}">
                                                            {{ $value1->nama_atribut }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <input type="text" class="form-control" value="{{ $key->value }}"
                                                    name="kriteria[{{ $value->id }}]">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach --}}

                        </div>

                        <button class="btn btn-primary" style="width: 100px" type="submit">Simpan</button>
                        <a href="/penilaian?tahun_awal={{ $result->tahun_awal . '&tahun_akhir=' . $result->tahun_akhir }}"
                            class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
