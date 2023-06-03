@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Staff {{ $staff->nama_staff }}</h4>

                    <form action="/staff/{{ $staff->id }}/update" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Staff</label>
                                    <input type="text" class="form-control" placeholder="First name"
                                        value="{{ $staff->nama_staff }}" required name="nama_staff">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Posisi</label>
                                    <select name="posisi_id" class="selectpicker form-select">
                                        @foreach ($positions as $position)
                                            @if (isset($staff->posisi->id))
                                                <option value="{{ $position->id }}"
                                                    @if ($position->id == $staff->posisi->id) selected @endif>
                                                    {{ $position->nama_posisi }}
                                                </option>
                                            @else
                                                <option value="">-</option>
                                                <option value="{{ $position->id }}">{{ $position->nama_posisi }}</option>
                                            @endif
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
