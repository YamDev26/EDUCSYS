@extends('auth')
@section("title", 'login')
@section('content')
<div class="card overflow-hidden text-center p-xxl-4 p-3 mb-0">
    <h4 class="fw-semibold mb-3 fs-18">Log in to your account</h4>
    <form action="{{ route('login') }}" method="post" class="text-start mb-3">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="votre adresse mail">
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password :</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="votre mot de passe">
        </div>
        <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
                <input type="remember_me" class="form-check-input" id="remember_me">
                <label class="form-check-label" for="remember_me-signin">Remember me</label>
            </div>
            <a href="{{ route('password.request') }}" class="text-muted border-bottom border-dashed">Forget Password</a>
        </div>
        <div class="d-grid">
            <button class="btn btn-primary fw-semibold" type="submit">Login</button>
        </div>
    </form>
</div>
@endsection
