@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Penilaian</h4>

                    <form action="{{ route('penilaian.index') }}" method="get">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tahun Awal Penilaian</label>
                                    <input type="text" class="form-control datepicker" id="datepicker" placeholder="YYYY"
                                        name="tahun_awal" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Tahun Akhir Penilaian</label>
                                    <input type="text" class="datepicker form-control" id="datepicker1"
                                        placeholder="YYYY" name="tahun_akhir" required>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
