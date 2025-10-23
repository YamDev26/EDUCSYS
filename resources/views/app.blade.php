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
    <style>
      /* Style du loader */
      #loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(18, 32, 37);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
      }

      #loader.fade-out {
        opacity: 0;
        pointer-events: none;
      }

      body.loading {
        overflow: hidden;
      }
    </style>
    @yield('link')
  </head>
  <body>
    <div id="loader">
      <div class="spinner-grow" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <div class="wrapper">
      <div class="sidenav-menu">
        @include('partials._navbar')
      </div>
        <!-- App header starts -->
        @include('partials._head')

      <!-- Search Modal -->
      <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form>
              <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                  <i class="ri-search-line fs-22"></i>
                  <input type="search" class="form-control bg-transparent fs-16 border-0" id="search-modal-input" placeholder="Search for actions, people,">
                  <button type="submit" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="page-content">
        <!-- App body starts -->
        @yield('content')

        <!-- App footer start -->
        @include('partials._footer')
      </div>
    </div>
    <!-- Required jQuery first JS -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script>
      window.addEventListener('load', function () {
        const loader = document.getElementById('loader');
        loader.classList.add('fade-out');
        document.body.classList.remove('loading'); // réactive le scroll
        setTimeout(() => loader.remove(), 500); // supprime après fondu
      });
    </script>
    @yield('script')
  </body>
</html>