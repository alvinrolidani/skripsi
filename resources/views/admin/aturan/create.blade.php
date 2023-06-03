@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Posisi</h4>

                    <form action="{{ route('aturan.store') }}" method="post">
                        @csrf
                        @foreach ($kriteria as $item)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{ $item->nama_kriteria }}</label>
                                        <select name="kriteria[{{ $item->id }}]" id="" class="form-select"
                                            required>
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Buruk">Buruk</option>
                                            <option value="Cukup">Cukup</option>
                                            <option value="Sangat Baik">Sangat Baik</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kesimpulan</label>
                                    <select name="nama_aturan" id="" class="form-select" required>
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="Sangat Buruk">Sangat Buruk</option>
                                        <option value="Buruk">Buruk</option>
                                        <option value="Cukup">Cukup</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                    </select>
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
