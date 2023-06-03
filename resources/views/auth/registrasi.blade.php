@extends('auth.layouts.main')
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h5 class="text-white font-size-20">Free Register</h5>
                                <p class="text-white-50 mb-0">Get your free Qovex account now</p>
                                <a href="index.html" class="logo logo-admin mt-4">
                                    <img src="/templates/layouts/assets/images/logoSmanell.png" alt=""
                                        height="60">
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-5">

                            <div class="p-2">
                                <form method="post" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control  @error('username') is-invalid @enderror"
                                            id="floatingInput" name="username" placeholder="12345">

                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="floatingInput">Username</label>

                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="floatingInput" name="name" placeholder="tes">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="floatingInput">Nama Lengkap</label>
                                    </div>


                                    <div class="row gx-2">
                                        <div class="form-floating mb-3  col-sm-6">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="floatingInput" placeholder="tes">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <label for="floatingInput">Password</label>
                                        </div>
                                        <div class="form-floating mb-3  col-sm-6">
                                            <input type="password"
                                                class="form-control @error('confirm_password') is-invalid @enderror"
                                                name="confirm_password" id="floatingInput" placeholder="tes">
                                            @error('confirm_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <label for="floatingInput">Confirm Password</label>
                                        </div>
                                    </div>

                                    <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                            name="submit">Register</button></div>
                                    <div class="col-auto text-center fs--1 text-600"><span class="mb-0 undefined">Sudah
                                            Punya
                                            Akun?</span>
                                        <span><a href="{{ route('auth') }}">Login</a></span>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">

                        <p>©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Qovex. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                            Themesbrand
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
