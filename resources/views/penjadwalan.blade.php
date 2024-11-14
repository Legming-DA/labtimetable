@extends('layouts.app')
@section('title', 'Proses Penjadwalan')

@section('content')
<section class="content-header">
    <!-- Content Header (Page header) code here -->
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card">
                    <div class="card-header">
                        <form action="{{ route('generate.new.solution') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-sm col-3">
                                <input type="number" name="pertemuan_per_kelas" id="pertemuan_per_kelas" min="1" placeholder="Pertemuan Praktikum" class="form-control" required>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-dark btn-flat">Generate</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        @if(isset($best_solution))
                        <p>Individu Terbaik : {{ is_array($best_solution) ? implode(', ', $best_solution) : $best_solution }} dengan Fitness: {{ $best_fitness }}</p>
                        @else
                        <p>Tidak Ada Proses Penjadwalan</p>
                        @endif

                        @if(session('success'))
                        <div id="alert" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Individu</th>
                                    <th>Fitness</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($population))
                                @php $counter = 1; @endphp
                                @foreach($population as $index => $kromosom)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ json_encode($kromosom) }}</td>
                                    <td>{{ $fitness_values[$index] }}</td>
                                </tr>
                                @php $counter++; @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="3">Klik Tombol Generate untuk Proses Penjadwalan</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts and plugins as per original code -->
@endsection