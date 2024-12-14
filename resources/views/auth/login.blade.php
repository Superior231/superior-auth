@extends('layouts.auth', ['active' => 'Login - Superior Auth'])

@section('content')
    <div class="row row-cols-1 justify-content-center mx-0 w-100" style="height: 100svh">
        <div class="col col-12 col-md-6 col-lg-4 mx-0 d-flex flex-column align-items-center">
            <div class="d-flex flex-column align-items-center pt-5 mt-5">
                <img src="{{ url('assets/images/logo.png') }}" alt="Superior Auth Logo" style="width: 80px; border-radius: 10%;">
                <h1 class="fw-bold text-color mt-3">Welcome!</h1>
                <h3 class="primary-color fw-bold">Login</h3>
            </div>

            <form method="POST" action="{{ route('login') }}" class="auth mt-5 w-100">
                @csrf
        
                <div class="content mb-3">
                    <div class="pass-logo">
                        <i class='bx bx-envelope'></i>
                    </div>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                </div>
        
                <div class="content mb-3">
                    <div class="pass-logo">
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="d-flex align-items-center position-relative">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" style="padding-right: 45px;" placeholder="Password" required>
                        <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100" id="showPass" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;" onclick="showPass()">
                            <i class="fa-regular fa-eye-slash"></i>
                        </div>
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-primary d-block fw-semibold w-100" type="submit">Login</button>
                </div>
                <p class="mb-0 mt-2 text-color text-center">
                    Not registered yet?
                    <a href="{{ route('register') }}" class="text-decoration-underline">Create an account!</a>
                </p>
            </form>
        </div>
    </div>
@endsection