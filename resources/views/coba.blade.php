
@extends('layouts.app')
@section('title', 'Algoritma Genetika')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Data Asisten Laboratorium</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Asisten Laboratorium</li>
                </ol>
            </div>
        </div>
    </div>
</section>
    <div class="container mt-5">
        <h1 class="mb-4">Jadwal Asisten Laboratorium</h1>
        <h3>Fitness Terbaik: {{ $fitness }}</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Sesi</th>
                    <th>Pengajar</th>
                    <th>Pendamping</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedule as $meeting)
                <tr>
                    <td>{{ $meeting['hari'] }}</td>
                    <td>{{ $meeting['sesi'] }}</td>
                    <td>{{ $assistants->firstWhere('id_asisten', $meeting['pengajar'])->nama }}</td>
                    <td>{{ $assistants->firstWhere('id_asisten', $meeting['pendamping'])->nama }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($iterations as $iteration)
            <h2>Generasi {{ $iteration['generation'] }}</h2>

            <h3>Populasi Awal</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Data Ke</th>
                    <th>Pengajar</th>
                    <th>Pendamping</th>
                    <th>Hari</th>
                    <th>Sesi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($iteration['initialPopulation'] as $groupIndex => $group)
                        @foreach ($group as $dataIndex => $population)
                            <tr>
                                <td>Data ke-{{ $dataIndex + 1 }}</td>
                                <td>{{ $population['pengajar'] }}</td>
                                <td>{{ $population['pendamping'] }}</td>
                                <td>{{ $population['hari'] }}</td>
                                <td>{{ $population['sesi'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
 
            {{-- Fitness --}}
            <h3>Fitness</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Fitness</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($iteration['fitness'] as $index => $fit)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $fit }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Selection --}}
            <h3>Hasil Seleksi</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Data Ke</th>
                        <th>Pengajar</th>
                        <th>Pendamping</th>
                        <th>Hari</th>
                        <th>Sesi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($iteration['selectPopulation']['selected'] as $groupIndex => $group)
                        @foreach ($group as $populationIndex => $population)
                        <tr>
                            <td>Data ke-{{ $populationIndex + 1 }}</td>
                            <td>{{ $population['pengajar'] }}</td>
                            <td>{{ $population['pendamping'] }}</td>
                            <td>{{ $population['hari'] }}</td>
                            <td>{{ $population['sesi'] }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            {{-- Random Selection --}}
            <h3>Random Selection</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Random Selection</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($iteration['selectPopulation']['randomSel'] as $index => $randomValue)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $randomValue }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Selection Probabilities --}}
            <h3>Selection Probabilities</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Selection Probability</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($iteration['selectPopulation']['selectionProbabilities'] as $index => $probability)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $probability }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Cumulative Probabilities --}}
            <h3>Cumulative Probabilities</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cumulative Probability</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($iteration['selectPopulation']['cumulativeProbabilities'] as $index => $cumulative)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $cumulative }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            {{-- Crossover --}}
            <h3>Hasil Crossover</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Data Ke</th>
                        <th>Pengajar</th>
                        <th>Pendamping</th>
                        <th>Hari</th>
                        <th>Sesi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($iteration['crossPopulation'] as $groupIndex => $group)
                        @foreach ($group as $populationIndex => $population)
                            <tr>
                                <td>Data ke-{{ $populationIndex + 1 }}</td>
                                <td>{{ $population['pengajar'] }}</td>
                                <td>{{ $population['pendamping'] }}</td>
                                <td>{{ $population['hari'] }}</td>
                                <td>{{ $population['sesi'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            {{-- Mutation --}}
            <h3>Hasil Mutasi</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Data Ke</th>
                        <th>Pengajar</th>
                        <th>Pendamping</th>
                        <th>Hari</th>
                        <th>Sesi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($iteration['mutPopulation'] as $groupIndex => $group)
                        @foreach ($group as $populationIndex => $population)
                            <tr>
                                <td>Data ke-{{ $populationIndex + 1 }}</td>
                                <td>{{ $population['pengajar'] }}</td>
                                <td>{{ $population['pendamping'] }}</td>
                                <td>{{ $population['hari'] }}</td>
                                <td>{{ $population['sesi'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            
        @endforeach
        
    </div>

@endsection
