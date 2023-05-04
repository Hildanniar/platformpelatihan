<!DOCTYPE html>
<html>

<head>
    <title>Data Peserta Pelatihan</title>
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
        <h5>Data Peserta Pelatihan</h4>

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
                <th>Kelas</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>No.Anggota Perpustakaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->users->email }}</td>
                    <td>{{ $participant->address }}</td>
                    <td>{{ $participant->no_hp }}</td>
                    <td>{{ $participant->class }}</td>
                    <td>{{ $participant->age }}</td>
                    <td>{{ $participant->gender }}</td>
                    <td>{{ $participant->profession }}</td>
                    <td>{{ $participant->no_member }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
