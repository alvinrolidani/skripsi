@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Kriteria</h4>

                    <form action="{{ route('kriteria.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label">Nama Kriteria</label>
                                    <input type="text" class="form-control" placeholder="Nama kriteria" value=""
                                        required name="nama_kriteria">
                                </div>
                                <div class="mb-3">

                                    <label class="form-label">Atribut Kriteria</label>
                                    <select name="atribut_kriteria" id="" class="form-select" required>
                                        <option value="" selected disabled>--Pilih--</option>
                                        <option value="benefit">Benefit</option>
                                        <option value="cost">Cost</option>
                                    </select>
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
