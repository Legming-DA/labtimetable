{{-- resources/views/coba.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Asisten Laboratorium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Proses Penjadwalan</h1>
        @foreach ($generationsData as $generationData)
        <h2>Generation {{ $generationData['generation'] }}</h2>
        <p><strong>Fitness:</strong> {{ implode(', ', $generationData['fitness']) }}</p>
        <h3>Tahap Seleksi</h3>
        <p><strong>Generate Random:</strong> {{ implode(', ', $generationData['random_selection']) }}</p>
        <p><strong>Probabilitas Individu:</strong> {{ implode(', ', $generationData['selection_probabilities']) }}</p>
        <p><strong>Probabilitas Kumulatif:</strong> {{ implode(', ', $generationData['cumulative_probabilities']) }}</p>
        <p><strong>Selected Population:</strong> {{ json_encode($generationData['selected_population']) }}</p>
        <h3>Tahap Crossover</h3>
        <p><strong>Crossover Population:</strong> {{ json_encode($generationData['crossover_population']) }}</p>
        <h3>Tahap Mutasi</h3>
        <p><strong>Mutated Population:</strong> {{ json_encode($generationData['mutated_population']) }}</p>
        <hr>
        @endforeach

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>