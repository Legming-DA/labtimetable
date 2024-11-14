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
        <h1 class="mb-4">Jadwal Asisten Laboratorium</h1>
        <h3>Fitness Terbaik: {{ $fitness }}</h3>
        <table class="table table-bordered">
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>