@extends('layouts.app')
@section('title', 'Input Data Siswa')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Tambah Data Kelas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Data Kelas</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Create</h3>
                </div>
                <form action="{{ route('kelasprak.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" class="form-control" name="kelas" placeholder="Kelas">
                        </div>
                        <div class="form-group">
                            <label>Hari</label>
                            <input type="text" class="form-control" name="hari" placeholder="Hari">
                        </div>
                        <div class="form-group">
                            <label>Sesi</label>
                            <input type="text" class="form-control" name="sesi" placeholder="Sesi">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1" aria-hidden="true"></i>Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->

        </div>
    </div>
</div>
<!-- /.card -->
<!-- DataTables  & Plugins -->

@endsection