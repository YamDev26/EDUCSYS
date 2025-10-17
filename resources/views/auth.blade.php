
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - {{ config('app.name') }}</title>
  <meta name="description" content="EducSys">
  <meta name="author" content="Jean-Marius YAO">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

  <!-- Icomoon Font Icons css -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
</head>
<body class="login-bg">
  <div class="container-fluid">
    <div class="row g-0">
      <div class="col-xl-8 col-lg-12 pt-xl-5">
        <div class="row">
          <div class="col-xl-6 col-lg-12 offset-xl-3">
            @error('email')
              <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                <p class="mb-0 flex-1" style="font-size: 12px">{{$message}}</p>
              </div>
            @enderror
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-12">
        <div class="row align-items-center justify-content-center">
          <div class="col-xl-8 col-sm-5 col-12" style="padding-top: 23%">
              @yield('content')
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>