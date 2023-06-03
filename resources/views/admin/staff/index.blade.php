@extends('admin.layouts.main')

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Staff Desa</h4>
                    <br>
                    <a href="{{ route('staff.create') }}" class="btn btn-success">Tambah</a>
                    <br>
                    <br>

                    <input type="text" id="search" name="search" placeholder="Cari Disini.." class="form-control  "
                        style="width: 20%;">
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Staff</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-center">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staff as $key => $item)
                                        <tr>
                                            <th class="text-center">{{ $key + $staff->firstItem() }}</th>
                                            <td class="text-center">{{ $item->nama_staff }}</td>
                                            @if ($item->posisi == null)
                                                <td class="text-center">-</td>
                                            @else
                                                <td class="text-center">{{ $item->posisi->nama_posisi }}</td>
                                            @endif
                                            <td class="text-center">
                                                <a href="{{ route('staff.show', $item->id) }}" class="btn">
                                                    <span class="mdi mdi-eye-outline" style="font-size:17px"></span>
                                                </a>
                                                <a href="{{ route('staff.edit', $item->id) }}" class="btn">
                                                    <i class="mdi mdi-pencil-outline" style="font-size:17px"></i>
                                                </a>
                                                <a class="btn">
                                                    <i class="mdi mdi-delete-outline" data-bs-toggle="modal"
                                                        style="font-size:17px"
                                                        data-bs-target=".deletestaff{{ $item->id }}"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        <div class="modal fade deletestaff{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0">Hapus Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <p>Apakah Anda Yakin ingin menghapus data dengan nama
                                                            {{ $item->nama_staff }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="/staff/{{ $item->id }}/destroy"
                                                            class="btn btn-primary waves-effect waves-light">Yakin</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-start">
                                <p>Showing {{ $staff->firstItem() }} to {{ $staff->lastItem() }} of {{ $staff->total() }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                {{ $staff->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
