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
<body>
<img src="assets/kop.png" alt="Header Image" style="width: 100%; margin-top: -40px;">

<h3>Penilaian Mahasiswa Magang Diskominfo Kota Semarang</h3>

<p>Sehubungan dengan berakhirnya periode magang yang dijalankan oleh :</p>

<table>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $mahasiswa->nama }}</td>
    </tr>
    <tr>
        <td>ID</td>
        <td>:</td>
        <td>{{ $mahasiswa->id_mhs }}</td>
    </tr>
    <tr>
        <td>Asal Instansi</td>
        <td>:</td>
        <td>{{ $mahasiswa->instansi }}</td>
    </tr>
    <tr>
        <td>Jurusan</td>
        <td>:</td>
        <td>{{ $mahasiswa->jurusan }}</td>
    </tr>
</table>

<p>Kami selaku pihak yang bertanggung jawab ingin menyampaikan penilaian atas kinerja magang yang bersangkutan dengan rincian sebagai berikut:</p>

<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Kriteria Penilaian</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($criteria as $key => $kriteria)
        <tr>
            <td style="text-align: center;">{{ $key < count($criteria) - 1 ? $key + 1 : '' }}</td>
            <td>{{ $kriteria }}</td>
            <td style="text-align: center; font-weight: {{ $key == count($criteria) - 1 ? 'bold' : 'normal' }}">
                @if(isset($nilai))
                    {{ $key == count($criteria) - 1 ? $nilai->nilai_avg : $nilai->{'nilai'.($key+1)} }}
                @else
                    N/A
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
</table>


<div class="ttd">
    <p id="tanggal">Semarang, {{ \Carbon\Carbon::parse($nilai->created_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</p>
    <p>Mengetahui,</p>
    <p style= "margin-top: -10px;">Sub Koordinator Pengembangan dan Pengelolaan Aplikasi Diskominfo Kota Semarang</p>
    <img src="https://cdn-image.hipwee.com/wp-content/uploads/2020/10/hipwee-Screen-Shot-2020-10-26-at-8.36.45-PM-875x640.png" alt="tanda tangan" width="150px">
    <p>Asdani Kindarto, S.Sos, M.Eng, Ph.D</p>
    <p style= "margin-top: -10px;">NIP. 197405221999031005</p>
</div>


</body>
</html>
