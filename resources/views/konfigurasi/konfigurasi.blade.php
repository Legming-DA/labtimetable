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

  
  @endsection