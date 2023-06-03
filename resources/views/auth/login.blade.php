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
                                <h5 class="text-white font-size-20">Welcome Back !</h5>
                                <p class="text-white-50 mb-0">Sign in to continue to Qovex.</p>
                                <a href="index.html" class="logo logo-admin mt-4">
                                    <img src="/templates/layouts/assets/images/logoSmanell.png" alt=""
                                        height="60">
                                </a>
                            </div>
                        </div>

                        <div class="card-body pt-5">
                            <div class="p-2">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-block-helper me-2"></i>{{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                                        </button>
                                    </div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-2"></i> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                                        </button>
                                    </div>
                                @endif
                                <form class="form-horizontal" action="{{ route('auth') }}" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" name="username"
                                            placeholder="12345">

                                        <label for="floatingInput">Username or NISN</label>

                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="userpassword" name="password"
                                            id="floatingInput" placeholder="Enter password">
                                        <label for="floatingInput">Password</label>
                                    </div>



                                    <div class="mt-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light"
                                            type="submit">Masuk</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p>Tidak punya akun ? <a href="/register" class="fw-medium text-primary">
                                                Daftar disini</a> </p>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">

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
