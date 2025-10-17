@extends('auth')
@section("title", 'login')
@section('content')
<form action="{{ route('login') }}" method="post" class="my-5">
    @csrf
    <div class="bg-white p-4 pb-1 rounded-3">
        <div class="login-form">
            <a href="#" class="mb-3 d-flex">
                <img src="{{ asset('assets/images/logo-dark.svg') }}" class="img-fluid login-logo" alt="Logo Cneter">
            </a>
            <h2 class="mt-4 mb-4">Login</h2>
            <div class="mb-3">
                <label class="email">Email<span class="text-danger">*</span> :</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="votre adresse mail">
            </div>
            <div class="mb-3">
                <label class="form-label">Password<span class="text-danger">*</span> :</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="votre mot de passe">
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check m-0">
                    <label>
                        <input type="checkbox" name="remember_me">
                        <span class="text-inverse">Remember me</span>
                    </label>
                </div>
                <a href="{{ route('password.request') }}" class="text-primary text-decoration-underline">Forgot Password</a>
            </div>
            <div class="d-grid py-3 mt-3 gap-2">
                <button type="submit" class="btn btn-lg btn-primary rounded-2 py-1">LOGIN</button>
            </div>
        </div>
    </div>
</form>
@endsection
