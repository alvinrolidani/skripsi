@extends('admin.layouts.main')

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Aturan</h4>
                    <br>
                    <a href="{{ route('aturan.create') }}" class="btn btn-success">Tambah</a>
                    <br>
                    <br>

                    <input type="text" id="search" name="search" placeholder="Cari Disini.." class="form-control  "
                        style="width: 20%;">
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="row" class="text-center"><b>No</b></th>
                                        @foreach ($kriteria as $item)
                                            <th scope="row" class="text-center"><b>{{ $item->nama_kriteria }}</b></th>
                                        @endforeach
                                        <th scope="row" class="text-center"><b>Kesimpulan</b></th>
                                        <th scope="row" class="text-center"><b>Aksi</b></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aturan as $key => $item)
                                        <tr>
                                            <th class="text-center">{{ $key + $aturan->firstItem() }}</th>
                                            @foreach ($item->kriteria as $key_1 => $value)
                                                <td class="text-center">{{ $value->pivot->value }}</td>
                                            @endforeach
                                            <th scope="row" class="text-center">{{ $item->nama_aturan }}</th>
                                            <td class="text-center">
                                                <a href="{{ route('kriteria.show', $item->id) }}" class="btn">
                                                    <span class="mdi mdi-eye-outline" style="font-size:17px"></span>
                                                </a>
                                                <a href="{{ route('kriteria.edit', $item->id) }}" class="btn">
                                                    <i class="mdi mdi-pencil-outline" style="font-size:17px"></i>
                                                </a>
                                                <a class="btn">
                                                    <i class="mdi mdi-delete-outline" data-bs-toggle="modal"
                                                        style="font-size:17px"
                                                        data-bs-target=".deleteaturan{{ $item->id }}"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        <div class="modal fade deleteaturan{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0">Hapus Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <p>Apakah Anda Yakin ingin menghapus data ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="/aturan/{{ $item->id }}/destroy"
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
                                <p>Showing {{ $aturan->firstItem() }} to {{ $aturan->lastItem() }} of
                                    {{ $aturan->total() }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                {{ $aturan->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
