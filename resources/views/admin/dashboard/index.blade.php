@extends('admin.layouts.main')
@section('content')
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->


    @include('sweetalert::alert')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <!-- end page title -->

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                <i class="mdi mdi-account-multiple"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Alternatif</div>
                        </div>
                    </div>
                    <h4 class="mt-4">{{ $alternatif }}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                <i class="mdi mdi-format-list-bulleted"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Kriteria</div>
                        </div>
                    </div>
                    <h4 class="mt-4">{{ $kriteria }}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                <i class="mdi mdi-playlist-plus"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Jumlah Bobot Kriteria</div>
                        </div>
                    </div>
                    @if ($bobot_kriteria == 100)
                        <h4 class="mt-4 text-danger">{{ $bobot_kriteria }} %</h4>
                    @else
                        <h4 class="mt-4 text-success">{{ $bobot_kriteria }} %</h4>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="avatar-sm font-size-20 me-3">
                        <span class="avatar-title bg-soft-primary text-primary rounded">
                            <i class="mdi mdi-tag-plus-outline"></i>
                        </span>
                    </div>
                    <div class="flex-1">
                        <div class="font-size-16 mt-2">Penilaian Terendah Pertahun</div>
                    </div>
                </div>
            </div>
            <div class="card-group">
                @if (count($tess))
                    @foreach ($tess as $key => $value)
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">

                                        <div class="flex-1">
                                            <div class="font-size-16 mt-2">
                                                {{ $key }}</div>
                                        </div>
                                    </div>
                                    <h4 class="mt-4">{{ $value['toko'] }}</h4>
                                    <div class="row">
                                        <div class="col-7">
                                            <p class="mb-0"><span class="text-danger" style="font-size:20px">
                                                    {{ $value['hasil'] }} </span></p>
                                        </div>
                                        <div class="col-5 align-self-center">
                                            <div class="btn btn-primary">Detail</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>


    </div>
    <!-- end row -->

    <!-- End Page-content -->
@endsection
