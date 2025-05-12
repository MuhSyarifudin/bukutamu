<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ session('token') }}">
  
  <link rel="icon" href="{{ url(asset('dist/img/favicon.png')) }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <title>{{ config('app.name', 'Laravel').' | '.$title}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/dist/css/adminlte.min.css') }}">


  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  @include('include.navigation-admin')
  @include('include.sidebar-admin')
    @yield('content')
  @include('include.footer-admin')
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ url('/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ url('/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ url('/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ url('/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('/plugins/chart.js/Chart.min.js') }}"></script>

@stack('js')

</body>
</html>