@extends('admin.layouts.main')
@section('content')
    @include('sweetalert::alert')
    <!-- end page title -->
    <style>
        .fileUpload {
            position: relative;
            overflow: hidden;
            margin: 10px;
        }

        .fileUpload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
    </style>
    <!-- start row -->
    <div class="row">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="oldImage" value="{{ auth()->user()->image }}">
                    <div class="profile-widgets py-3">
                        <div class="text-center">
                            <div class="">
                                @if (auth()->user()->image)
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                                        class="avatar-lg mx-auto img-thumbnail rounded-circle" id="load_gambar">
                                @else
                                    <img src="/templates/layouts/assets/images/user/default.png" alt=""
                                        class="avatar-lg mx-auto img-thumbnail rounded-circle" id="load_gambar">
                                @endif
                                <div class="online-circle"><i class="fas fa-circle text-success"></i>
                                </div>
                            </div>
                            <div class="mt-3 ">
                                <div class="fileUpload btn">
                                    <a href="#" style="">Ganti Profil</a>
                                    <input class="upload @error('gambar') is-invalid @enderror" type="file"
                                        name="image" id="preview">
                                </div>

                            </div>


                        </div>

                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control  @error('username') is-invalid @enderror"
                            id="floatingInput" name="username" placeholder="12345" value="{{ auth()->user()->username }}">

                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="floatingInput">Username atau NISN</label>

                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput"
                            name="name" placeholder="tes" value="{{ auth()->user()->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="floatingInput">Nama Lengkap</label>
                    </div>


                    <div class="row gx-2">

                        {{-- <div class="form-floating mb-3 col-sm-6">
                            <select class="form-select @error('level') is-invalid @enderror" id="floatingSelect"
                                aria-label="Floating label select example" name="level">
                                <option selected disabled>--Pilih--</option>
                                <option {{ auth()->user()->level == 'admin' ? 'selected' : '' }} value="admin">
                                    Administrator</option>
                                <option {{ auth()->user()->level == 'kepala sekolah' ? 'selected' : '' }}
                                    value="kepala sekolah">Kepala Sekolah</option>
                                <option {{ auth()->user()->level == 'wali kelas' ? 'selected' : '' }} value="wali kelas">
                                    Wali
                                    Kelas</option>
                                <option {{ auth()->user()->level == 'siswa' ? 'selected' : '' }} value="siswa">Siswa
                                </option>

                            </select>
                            @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="floatingSelect ">Level</label>
                        </div> --}}
                    </div>



                    <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit"
                            name="submit">Simpan</button></div>
                </form>

            </div>
        </div>
    </div>
@endsection
