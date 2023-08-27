@extends('admin.layouts.main')

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Posisi</h4>
                    <br>
                    <input type="hidden" value="{{ $total }}" id="total">
                    <a onclick="count()" class="btn btn-primary">Tambah</a>
                    <br>
                    <br>

                    <form action="/kriteria" method="get" class="search">
                        <div class="col-lg-4">
                            <table>


                                <tr>
                                    <th><input type="text" class="form-control" name="search"
                                            placeholder="Cari Disini..."></th>
                                    <th><button type="submit" class="btn btn-success"><i
                                                class="mdi mdi-magnify"></i></button></th>
                                    <th><button value="" class="btn btn-secondary">Reset</button></th>
                                </tr>
                            </table>
                        </div>
                    </form>
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Kriteria</th>

                                        <th class="text-center">Bobot Kriteria</th>
                                        <th class="text-center">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($kriteria) > 0)
                                        @foreach ($kriteria as $key => $item)
                                            <tr>
                                                <th class="text-center">{{ $key + $kriteria->firstItem() }}</th>
                                                <td class="text-center">{{ $item->nama_kriteria }}</td>
                                                <td class="text-center">{{ $item->bobot_kriteria * 100 }}%</td>
                                                <td class="text-center">
                                                    @if (array_key_exists($item->kode_kriteria, $hitung))
                                                        <a href="/kriteria_crips/{{ $item->id }}" class="btn">
                                                            <span class="mdi mdi-eye-outline" style="font-size:17px"></span>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('kriteria_crips.create', $item->id) }}"
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
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data yang ditemukan</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-start">
                                <p>Showing {{ $kriteria->firstItem() }} to {{ $kriteria->lastItem() }} of
                                    {{ $kriteria->total() }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                {{ $kriteria->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <script>
        function count() {
            var total = document.getElementById('total').value;
            // console.log(total);
            if (total == 1) {
                alert('Bobot sudah 100%', 'Kurangi Bobot Jika Ingin menambahkan kriteria')
            } else {
                window.location.href = "{{ route('kriteria.create') }}"
            }
        }
    </script>
@endsection
