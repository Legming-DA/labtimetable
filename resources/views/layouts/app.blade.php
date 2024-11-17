<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
</head>

<body class="sidebar-mini layout-navbar-fixed sidebar-open" style="height: auto;">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-info navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ asset('/') }}index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-blue">
      <!-- Brand Logo -->
      <a href="{{ asset('/') }}home.php" class="brand-link" class="sidebar sidebar-info sidebar-dark">
        <img src="{{ asset('/') }}dist/img/AdminLogo1.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span href="{{ url('/') }}" class="brand-text font-weight-light">LabTimeTable</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar ">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('/') }}dist/img/avatar3.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Asisten Lab</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ url('/') }}" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Dashboard
                  <i class="#"></i>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/asisten') }}" class="nav-link">
                <!-- <i class="nav-icon fas fa-copy"></i> -->
                <i class="nav-icon fa fa-address-card" aria-hidden="true"></i>
                <p>
                  Data Asisten Lab
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/kelasprak') }}" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Data Kelas Praktikum
                </p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="{{ url('/hari') }}" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Data Hari Praktikum
                </p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="{{ url('/ketersediaan') }}" class="nav-link">
                <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                <p>
                  Data Ketersediaan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/konfigurasi') }}" class="nav-link">
                <i class="nav-icon fa fa-graduation-cap" aria-hidden="true"></i>
                <p>
                  Konfigurasi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/penjadwalan') }}" class="nav-link">
                <i class=" nav-icon fa fa-tasks" aria-hidden="true"></i>
                <p>
                  Proses Penjadwalan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/generate') }}" class="nav-link">
                <i class=" nav-icon fa fa-tasks" aria-hidden="true"></i>
                <p>
                  Arsip Jadwal
                </p>
              </a>
            </li>
            <!-- <li class="nav-item">
            <a href="{{ url('/report') }}" class="nav-link">
              <i class="nav-icon fa fa-file" aria-hidden="true"></i>
              <p>
                Reports
              </p>
            </a>
          </li> -->

            <li class="nav-item">
              <a href="{{ url('/keluar') }}" class="nav-link">
                <!-- <i class="nav-icon fas fa-table"></i> -->
                <!-- <i class="fa fa-folder" aria-hidden="true"></i> -->
                <i class="nav-icon fa fa-window-close" aria-hidden="true"></i>
                <p>
                  Sign Out
                </p>
              </a>
            </li>
            <!-- <li class="nav-header">EXAMPLES</li> -->



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
      @yield('content')
    </div>


    <!-- /.card-footer-->
  </div>


  <footer class="main-footer">
    <!-- <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div> -->
    <strong>Copyright &copy; 2023 <a href="https://www.instagram.com/dislab_itnmalang?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">Dislab</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
   <!-- jQuery -->
  <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>

  <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  
  <!-- Bootstrap 4 -->
  <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="{{ asset('/dist/js/demo.js') }}"></script> -->
  <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>

</html>