@extends('layouts.app')
@section('title', 'Data Kelas')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="font-weight-bold">Data Hari Praktikum</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Hari Praktikum</li>
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
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="button-container">
              <a href="{{route('hari.create')}}" class="btn btn-dark btn-sm">
                <i class="fa fa-plus-square mr-1" aria-hidden="true"></i>
                Add
              </a>
              <a href="" class="btn btn-warning btn-sm">
                <i class="fas fa-file mr-1"></i> Report
              </a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if(session('success'))
            <div id="alert" class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="sorting sorting_asc">No.</th>
                  <th>Hari</th>
                  <th>Sesi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($hari as $data)
                <tr>
                  <td>{{ $data->id_hari }}</td>
                  <td>{{ $data->hari }}</td>
                  <td>{{ $data->sesi }}</td>
                  <td>
                    <div class="text-center">
                      <a href="{{ route ('hari.edit', ['hari' => $data->id_hari]) }}">
                        <button type="button" class="btn btn-success btn-xs d-inline-block">
                          <i class="fas fa-edit mr-1"></i>Edit</button>
                      </a>
                      <form action="{{ route('hari.destroy', $data->id_hari) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs d-inline-block" onclick="return confirm ('Apakah Data Ingin Dihapus?')">
                          <i class="fa fa-trash mr-1"></i>Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
                <!-- <td>1.</td>
                <td>Senin</td>
                <td>1</td>
                <td>
                    <div class="text-center">
                      <a href="">
                        <button type="button" class="btn btn-success btn-xs d-inline-block">
                          <i class="fas fa-edit mr-1"></i>Edit</button>
                      </a>
                      <form  style="display: inline;">
                    
                        <button type="submit" class="btn btn-danger btn-xs d-inline-block" onclick="return confirm ('Apakah Data Ingin Dihapus?')">
                          <i class="fa fa-trash mr-1"></i>Delete</button>
                      </form>
                    </div>
                  </td> -->
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
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