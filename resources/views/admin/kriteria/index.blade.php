@extends('admin.layouts.main')

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Kriteria</h4>
                    <br>
                    <a href="{{ route('kriteria.create') }}" class="btn btn-primary">Tambah</a>
                    <br>
                    <br>


                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Kriteria</th>
                                        <th class="text-center">Atribut Kriteria</th>
                                        <th class="text-center">Bobot Kriteria</th>
                                        <th class="text-center">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($kriteria as $key => $item)
                                        <tr>
                                            <th class="text-center">{{ $loop->iteration }}</th>
                                            <td class="text-center">{{ $item->nama_kriteria }}</td>
                                            <td class="text-center">{{ ucwords($item->atribut_kriteria) }}</td>
                                            <td class="text-center">{{ $item->bobot_kriteria * 100 }}%</td>
                                            <td class="text-center">
                                                @if (array_key_exists($item->id, $hitung))
                                                    <a href="/atribut_penilaian/{{ $item->id }}" class="btn">
                                                        <span class="mdi mdi-eye-outline" style="font-size:17px"></span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('atribut_penilaian.create', $item->id) }}"
                                                        class="btn">
                                                        <span class="mdi mdi-plus" style="font-size:17px"></span>
                                                    </a>
                                                @endif

                                                <a href="{{ route('kriteria.edit', $item->id) }}" class="btn">
                                                    <i class="mdi mdi-pencil-outline" style="font-size:17px"></i>
                                                </a>
                                                <a class="btn">
                                                    <i class="mdi mdi-delete-outline" data-bs-toggle="modal"
                                                        style="font-size:17px"
                                                        data-bs-target=".deletekriteria{{ $item->id }}"></i>
                                                </a>
                                            </td>

                                        </tr>

                                        <div class="modal fade deletekriteria{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0">Hapus Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <p>Apakah Anda Yakin ingin menghapus data dengan nama
                                                            {{ $item->nama_kriteria }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="/kriteria/{{ $item->id }}/destroy"
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

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
