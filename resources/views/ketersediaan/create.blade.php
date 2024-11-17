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
                <form action="{{ route('ketersediaan.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <!-- <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama">
                        </div> -->
                        <div class="form-group">
                            <label>Nama Asisten</label>
                            <select class="form-control" id="id_asisten" name="id_asisten">
                                <option value="">Pilih Asisten</option>
                                @foreach ($tersediaList2 as $tersediaId2 => $namaTersedia)
                                <option value="{{ $tersediaId2 }}">{{ $namaTersedia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ketersediaan</label>
                            <select class="form-control" id="id_kelasprak" name="id_kelasprak">
                                <option value="">Pilih Kelas</option>
                                @foreach ($tersediaList as $tersediaId => $kelasTersedia)
                                <option value="{{ $tersediaId }}">{{ $kelasTersedia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1" aria-hidden="true"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection