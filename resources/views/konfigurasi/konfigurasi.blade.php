@extends('layouts.app')
@section('title', 'Konfigurasi')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="font-weight-bold">Konfigurasi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Konfigurasi</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-info card-outline">
        <div class="card">
          <div class="card-header">
            <form action="{{ route('konfigurasi.store') }}" method="POST">
              @csrf
              <input type="hidden" name="kd" value="{{ $konfigurasi->kd ?? '' }}">
              <div class="card-body">
                <div class="form-group">
                  <label>Inisialisasi Populasi</label>
                  <input type="text" class="form-control" name="popsize" placeholder="Populasi" value="{{ old('popsize', $konfigurasi->popsize ?? '') }}">
                </div>
                <div class="form-group">
                  <label>Generasi</label>
                  <input type="text" class="form-control" name="generasi" placeholder="Generasi" value="{{ old('generasi', $konfigurasi->generasi ?? '') }}">
                </div>
                <div class="form-group">
                  <label>Crossover Rate</label>
                  <input type="text" class="form-control" name="crossrate" placeholder="Crossover Rate" value="{{ old('crossrate', $konfigurasi->crossrate ?? '') }}">
                </div>
                <div class="form-group">
                  <label>Mutation Rate</label>
                  <input type="text" class="form-control" name="mutrate" placeholder="Mutation Rate" value="{{ old('mutrate', $konfigurasi->mutrate ?? '') }}">
                </div>

                <button type="submit" class="btn btn-info">Submit</button>
                @if(session('success'))
                <div id="alert" class="alert alert-success mt-2">
                  {{ session('success') }}
                </div>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- DataTables  & Plugins -->
  <script>
    // Setelah halaman dimuat, atur waktu tampilan pesan alert selama 5 detik
    window.onload = function() {
      setTimeout(function() {
        var alertElement = document.getElementById('alert');
        if (alertElement) {
          alertElement.style.display = 'none';
        }
      }, 2000); //2 detik
    };
  </script>

  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
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
  @endsection