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
    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{asset ('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}" />
  </head>
  <body">
    <div class="page-wrapper">
      <div class="app-container">

        <!-- App header starts -->
        @include('partials._head')

        <!-- App navbar starts -->
        @include('partials._navbar')

        <!-- App body starts -->
        <div class="app-body">
             @yield('content')
        </div>

        <!-- App footer start -->
        @include('partials._footer')
      </div>
    </div>
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Overlay Scroll JS -->
    <script src="{{asset ('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>
    <!-- Apex Charts -->
    <script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/tasks.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/ticketsData.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/avgTimeData.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/tickets.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/calls.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/callsByCountry.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/sparkline.js') }}"></script>
    <!-- Custom JS files -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>