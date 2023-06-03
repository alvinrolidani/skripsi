@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Staff {{ $staff->nama_staff }}</h4>

                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Staff</label>
                                <input type="text" class="form-control" placeholder="First name"
                                    value="{{ $staff->nama_staff }}" disabled name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                @if (isset($staff->posisi->id))
                                    <label class="form-label">Posisi</label>
                                    <input type="text" class="form-control" value="{{ $staff->posisi->nama_posisi }}"
                                        name="" id="" disabled>
                                @else
                                    <label class="form-label">Posisi</label>
                                    <input type="text" class="form-control" value="-" name="" id=""
                                        disabled>
                                @endif


                            </div>
                        </div>
                    </div>



                    <a href="{{ route('staff.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
