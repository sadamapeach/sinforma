<h3><center>Daftar Akun Mahasiswa Magang Diskominfo Kota Semarang</center></h3>
<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>ID</th>
    <th>Username</th>
    <th>Password</th>
  </tr>
  {{ $i = 1 }}
  @foreach ($accounts as $account)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $account->nama }}</td>
        <td>{{ $account->id_mhs }}</td>
        <td>{{ $account->username }}</td>
        <td>{{ $account->password }}</td>
    </tr>
  @endforeach
</table>