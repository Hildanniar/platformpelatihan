<!DOCTYPE html>
<html>

<head>
    <title>Data Mentor Pelatihan</title>
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
        <h5>Data Mentor Pelatihan</h4>

        </h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No.Telp</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>No.Anggota Perpustakaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mentors as $mentor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mentor->name }}</td>
                    <td>{{ $mentor->users->email }}</td>
                    <td>{{ $mentor->address }}</td>
                    <td>{{ $mentor->no_hp }}</td>
                    <td>{{ $mentor->age }}</td>
                    <td>{{ $mentor->gender }}</td>
                    <td>{{ $mentor->profession }}</td>
                    <td>{{ $mentor->no_member }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
