@extends('layouts.app')
@section('title', 'Generate Jadwal')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="font-weight-bold">Generate Jadwal</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Generate Jadwal</li>
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
              <a href="#" class="btn btn-dark btn-sm">
                Generate Jadwal
              </a>
              <a href="" class="btn btn-warning btn-sm">
                <i class="fas fa-file mr-1"></i> Report
              </a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="sorting sorting_asc">No.</th>
                  <th>Pengajar</th>
                  <th>Pendamping</th>
                  <th>Hari</th>
                  <th>Sesi</th>
                </tr>
              </thead>
              <tbody>
               
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
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

@endsection