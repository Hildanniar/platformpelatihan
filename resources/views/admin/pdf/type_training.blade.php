<!DOCTYPE html>
<html>

<head>
    <title>Data Jenis Pelatihan</title>
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
        <h5>Data Jenis Pelatihan</h4>

        </h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelatihan</th>
                <th>Kelas</th>
                <th>Kuota Pelatihan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($type_trainings as $type)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->class }}</td>
                    <td>{{ $type->quota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
