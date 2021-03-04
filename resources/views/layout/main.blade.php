<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>@yield('title')</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/summernote/summernote-bs4.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
  <style type="text/css">
    .divider{
      width: 100%;
      height: 1px;
      background: #BBB;
      margin: 1rem 0;
    }
    .table-scroll {
      display:block;
      width: 22rem;
      height : 20rem;
      overflow-y : scroll;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('browsing') }}" class="nav-link">Browsing</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('searching.index') }}" class="nav-link">Searching</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('rekomendasi.index') }}" class="nav-link">Rekomendasi</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('info') }}" class="nav-link">Info</a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="container">
        <a href="{{ route('home') }}" class="brand-link">
        <i class="nav-icon fas fa-motorcycle"></i>
        <span class="brand-text font-weight-light">Sepeda Motor</span>
        </a>
    </div>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Kriteria Sepeda Motor
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('listmerek.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Merek</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('listtransmisi.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transmisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('listtype.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Type Motor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('listtahun.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tahun Produksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('listvolume.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Volume Silinder</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('browsing') }}" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Browsing
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('searching.index') }}" class="nav-link">
              <i class="nav-icon fas fa-search-plus"></i>
              <p>
                Searching
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('rekomendasi.index') }}" class="nav-link">
              <i class="nav-icon fa fa-thumbs-up"></i>
              <p>
                Rekomendasi
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  @yield('container')

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ URL::asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ URL::asset('dist/js/adminlte.js') }}"></script>
<script src="{{ URL::asset('dist/js/pages/dashboard.js') }}"></script>
<script src="{{ URL::asset('dist/js/demo.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

@yield('js')

</body>
</html>
