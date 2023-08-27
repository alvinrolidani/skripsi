@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Toko {{ $toko->nama_toko }}</h4>

                    <form action="/toko/{{ $toko->id }}/update" method="post">
                        @csrf
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Toko</label>
                                        <input type="text" class="form-control" placeholder="Nama Toko"
                                            value="{{ $toko->nama_toko }}" required name="nama_toko">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lokasi Toko</label>
                                        <select name="lokasi_toko" id="" class="form-select" required>
                                            <option value="" disabled>--Pilih--</option>
                                            <option value="pasar jasinga"
                                                {{ $toko->lokasi_toko == 'pasar jasinga' ? 'selected' : '' }}>Pasar Jasinga
                                            </option>
                                            <option value="pasar rangkasbitung"
                                                {{ $toko->lokasi_toko == 'pasar rangkasbitung' ? 'selected' : '' }}>Pasar
                                                Rangkasbitung</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <button class="btn btn-primary" style="width: 100px" type="submit">Simpan</button>
                        <a href="{{ route('toko.index') }}" class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
