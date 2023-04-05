<!DOCTYPE html>
<html>

<head>
    <title>Data Pengguna</title>
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
        <h5>Data Pengguna</h4>

        </h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Usia</th>
                <th>Alamat</th>
                <th>No.HP</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>No.Anggota Perpustakaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->profession }}</td>
                    <td>{{ $user->no_member }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
