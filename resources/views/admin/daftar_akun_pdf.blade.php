<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa Magang Diskominfo Kota Semarang</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            padding-left: 30px;
            padding-right: 50px;
        }

        th, td {
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        h3 {
            text-align: center;
        }

        p {
            margin-top: 10px;
            margin-left: 30px;
            margin-right: 50px;
        }

        .ttd {
            margin-top: 20px;
            margin-left: 350px;
            text-align: left;
        }
    </style>
</head>

<img src="assets/kop.png" alt="Header Image" style="width: 100%; margin-top: -40px;">
<h3><center>Daftar Akun Mahasiswa Magang Diskominfo Kota Semarang</center></h3>
<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>No</th>
    <th>ID</th>
    <th>Nama</th>
    <th>Username</th>
    <th>Password</th>
  </tr>
  {{ $i = 1 }}
  @foreach ($accounts as $account)
    <tr>
        <td style="text-align: center;">{{ $i++ }}</td>
        <td style="text-align: center;">{{ $account->id_mhs }}</td>
        <td>{{ $account->nama }}</td>
        <td>{{ $account->username }}</td>
        <td>{{ $account->password }}</td>
    </tr>
  @endforeach
</table>
</html>