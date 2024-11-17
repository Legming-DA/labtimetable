@extends('layouts.app')
@section('title', 'Data Kelas')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="font-weight-bold">Data Kelas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Kelas Praktikum</li>
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
              <a href="{{route('kelasprak.create')}}" class="btn btn-dark btn-sm">
                <i class="fa fa-plus-square mr-1" aria-hidden="true"></i>
                Add
              </a>
              <a href="" class="btn btn-warning btn-sm">
                <i class="fas fa-file mr-1"></i> Report
              </a>
            </div>
          </div>
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
                  <th>Kelas</th>
                  <th>Hari</th>
                  <th>Sesi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($kelasprak as $data)
                <tr>
                  <td>{{ $data->id_kelasprak }}</td>
                  <td>{{ $data->kelas }}</td>
                  <td>{{ $data->hari }}</td>
                  <td>{{ $data->sesi }}</td>
                  <td>
                    <div class="text-center">
                      <a href="{{ route ('kelasprak.edit', ['kelasprak' => $data->id_kelasprak]) }}">
                        <button type="button" class="btn btn-success btn-xs d-inline-block">
                          <i class="fas fa-edit mr-1"></i>Edit</button>
                      </a>
                      <form action="{{ route('kelasprak.destroy', $data->id_kelasprak) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs d-inline-block" onclick="return confirm ('Apakah Data Ingin Dihapus?')">
                          <i class="fa fa-trash mr-1"></i>Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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