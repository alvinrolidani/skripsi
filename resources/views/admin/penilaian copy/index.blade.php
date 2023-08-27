@extends('admin.layouts.main')

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Penilaian</h4>
                    <br>

                    <form action="{{ route('penilaian.create') }}">
                        <input type="hidden" value="{{ $tAwal }}" name="tahun_awal">
                        <input type="hidden" value="{{ $tAkhir }}" name="tahun_akhir">
                        <button class="btn btn-primary">Tambah</button>
                    </form>
                    <br>
                    <div class="col-lg-12">



                        <div id="myChart" style="height: 320px"></div>

                    </div>
                </div>
                <br>
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>


                                    <th scope="row" class="text-center"><b>Nama Toko</b></th>
                                    <th scope="row" class="text-center"><b>Periode Penilaian</b></th>
                                    <th scope="row" class="text-center"><b>Total Nilai</b></th>
                                    <th scope="row" class="text-center"><b>Peringkat</b></th>
                                    <th scope="row" class="text-center"><b>Kesimpulan</b></th>
                                    <th scope="row" class="text-center"><b>Aksi</b></th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($result as $key => $item)
                                    <tr>

                                        <td class="text-center">{{ $item->toko->nama_toko }}</td>
                                        <td class="text-center">
                                            {{ $item->tahun_awal . ' - ' . $item->tahun_akhir }}
                                        </td>

                                        <th scope="row" class="text-center">{{ $item->hasil }}</th>
                                        <th scope="row" class="text-center">{{ $item->rank }}</th>


                                        <th scope="row" class="text-center">{{ $item->kesimpulan }}</th>

                                        <td class="text-center">
                                            @if (auth()->user()->level == 'user')
                                                <a href="{{ route('penilaian.show', $item->id) }}" class="btn">
                                                    <span class="mdi mdi-eye-outline" style="font-size:17px"></span>
                                                </a>
                                                <a href="{{ route('penilaian.edit', $item->id) }}" class="btn">
                                                    <i class="mdi mdi-pencil-outline" style="font-size:17px"></i>

                                                </a>
                                            @else
                                                <a href="{{ route('penilaian.show', $item->id) }}" class="btn">
                                                    <span class="mdi mdi-eye-outline" style="font-size:17px"></span>
                                                </a>
                                                <a href="{{ route('penilaian.edit', $item->id) }}" class="btn">
                                                    <i class="mdi mdi-pencil-outline" style="font-size:17px"></i>
                                                </a>
                                                <a class="btn">
                                                    <i class="mdi mdi-delete-outline" data-bs-toggle="modal"
                                                        style="font-size:17px"
                                                        data-bs-target=".deletepenilaian{{ $item->id }}"></i>
                                                </a>
                                            @endif



                                        </td>

                                    </tr>
                                    <div class="modal fade deletepenilaian{{ $item->id }}" tabindex="-1"
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
                                                    <form action="{{ route('penilaian.destroy', $item->toko->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="tahun_awal"
                                                            value="{{ $tAwal }}">
                                                        <input type="hidden" name="tahun_akhir"
                                                            value="{{ $tAkhir }}">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">Yakin</button>
                                                    </form>
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
@section('chart')
    <script src="templates/layouts/assets/js/pages/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>

    <script>
        var x = {!! $hasilX !!}

        // Highcharts.chart('myChart', {
        //     chart: {
        //         type: 'area'
        //     },
        //     title: {
        //         text: 'Total Nilai'
        //     },
        //     subtitle: {
        //         text: 'Metode Complex Proportional Assessment'
        //     },
        //     xAxis: {
        //         categories: x,
        //         labels: {
        //             autoRotation: [-45, -90],
        //             style: {
        //                 fontSize: '13px',
        //                 fontFamily: 'Verdana, sans-serif'
        //             }
        //         }
        //     },
        //     yAxis: {
        //         min: 0,
        //         title: {
        //             text: 'Total Nilai'
        //         }
        //     },
        //     legend: {
        //         enabled: false
        //     },
        //     series: [{
        //         name: 'coba',
        //         colors: [
        //             '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
        //             '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
        //             '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
        //             '#03c69b', '#00f194'
        //         ],
        //         colorByPoint: true,
        //         groupPadding: 0,
        //         data: {!! $hasilY !!},
        //         dataLabels: {
        //             enabled: true,
        //             format: '{point.y:.0f}'
        //         },

        //     }],
        //     tooltip: {
        //         pointFormat: 'Total Nilai : <b>{point.y}</b>'
        //     },

        // });
        // Set up the chart
        Highcharts.chart('myChart', {
            chart: {
                type: 'area'
            },
            title: {
                text: 'Total Nilai'
            },
            subtitle: {
                text: 'Metode Complex Proportional Assessment'
            },
            xAxis: {
                categories: x
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Nilai'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Total Nilai Setiap Toko',
                data: {!! $hasilY !!},
                color: '#7C0000'
            }],
            tooltip: {
                formatter: function() {
                    return 'Nama Toko : <b>' + this.x +
                        '</b><br> Total Nilai :  <b>' + this.y + '</b><br>Kesimpulan : <b>' + this.key + '</b>';
                }
            },
        });
    </script>
@endsection
