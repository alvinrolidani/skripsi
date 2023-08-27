@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Toko</h4>

                    <form action="{{ route('toko.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label">Nama Toko</label>
                                    <input type="text" class="form-control" placeholder="Nama Toko" value=""
                                        required name="nama_toko">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">

                                    <label class="form-label">Lokasi Toko</label>
                                    <select name="lokasi_toko" id="" class="form-select" required>
                                        <option value="" selected disabled>--Pilih--</option>
                                        <option value="pasar jasinga">Pasar Jasinga</option>
                                        <option value="pasar rangkasbitung">Pasar Rangkasbitung</option>
                                    </select>
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
