<!DOCTYPE html>
<html>

<head>
    <title>Data Jadwal Pelatihan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Data Jadwal Pelatihan</h4>

        </h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pelatihan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Akhir</th>
                    <th>Jam Mulai</th>
                    <th>Jam Akhir</th>
                </tr>
            </thead>
        </thead>
        <tbody>
            @foreach ($schedules as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->type_trainings->name ?? 'none' }}</td>
                    <td>{{ $s->start_date }}</td>
                    <td>{{ $s->end_date }}</td>
                    <td>{{ $s->start_time }}</td>
                    <td>{{ $s->end_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
