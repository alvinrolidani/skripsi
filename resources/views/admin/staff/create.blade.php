@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Staff</h4>

                    <form action="{{ route('staff.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Staff</label>
                                    <input type="text" class="form-control" placeholder="Nama Staff" value=""
                                        required name="nama_staff">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Posisi</label>
                                    <select name="posisi_id" class="selectpicker form-select">
                                        <option value="" disabled>Pilih Posisi</option>
                                        <option value="">-</option>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" style="width: 100px" type="submit">Simpan</button>
                        <a href="{{ route('staff.index') }}" class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
