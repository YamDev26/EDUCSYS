
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title')</title>
  <meta name="description" content="EducSys">
  <meta name="author" content="Jean-Marius YAO">
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo_2.jpg') }}">
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">
  <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="auth-bg d-flex min-vh-100">
    <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
      <div class="col-xxl-3 col-lg-5 col-md-6 mt-5">
        @include('partials._alert')
        <a href="#" class="auth-brand d-flex justify-content-center mb-2">
          <strong class="my-0"  style="font-size: 19px;">
            CENTRE <span style="color: rgb(255, 244, 41); font-weight: bold;">THALITH</span>
          </strong>
          {{-- <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo" height="26" class="logo-dark">
          <img src="{{ asset('assets/images/logo.png') }}" alt="logo light" height="26" class="logo-light"> --}}
        </a>
        @yield('content')
        <p class="mt-4 text-center mb-0">
          <script>document.write(new Date().getFullYear())</script> © {{ config('app.name') }} - By 
          <span class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">CENTRE THALITH</span>
        </p>
      </div>
    </div>
  </div>

  <!-- Vendor js -->
  <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>