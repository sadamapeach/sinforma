<h3 style="text-align: center;">Penilaian Mahasiswa Magang Diskominfo Kota Semarang</h3>
<table>
    <tr>
        <td class="py-2 px-4 border border-black">Nama</td>
        <td class="py-2 px-4 border border-black">:</td>
        <td class="py-2 px-4 border border-black">{{ $mahasiswa->nama }}</td>
    </tr>
    <tr>
        <td class="py-2 px-4 border border-black">ID</td>
        <td class="py-2 px-4 border border-black">:</td>
        <td class="py-2 px-4 border border-black">{{ $mahasiswa->id_mhs }}</td>
    </tr>
    <tr>
        <td class="py-2 px-4 border border-black">Instansi</td>
        <td class="py-2 px-4 border border-black">:</td>
        <td class="py-2 px-4 border border-black">{{ $mahasiswa->instansi }}</td>
    </tr>
    <tr>
        <td class="py-2 px-4 border border-black">Jurusan</td>
        <td class="py-2 px-4 border border-black">:</td>
        <td class="py-2 px-4 border border-black">{{ $mahasiswa->jurusan }}</td>
    </tr>
</table>

</br>
<table border="1" cellspacing="0" cellpadding="5" class="min-w-full border border-black border-collapse dark:border-black-600 rounded-lg">
    <thead class="bg-gray-100 dark:bg-gray-800">
        <tr>
            <th class="py-2 px-4 border border-black">No</th>
            <th class="py-2 px-4 border border-black">Kriteria Penilaian</th>
            <th class="py-2 px-4 border border-black">Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($criteria as $key => $kriteria)
            <tr>
                <td class="py-2 px-4 border border-black text-center">
                    @if ($key < count($criteria) - 1)
                        {{ $key + 1 }}
                    @endif
                </td>
                <td class="py-2 px-4 border border-black">{{ $kriteria }}</td>
                <td class="py-2 px-4 border border-black">
                    @if ($key < count($criteria) - 1)
                        @if(isset($nilai))
                            {{ $nilai->{'nilai'.($key+1)} }}
                        @else
                            N/A
                        @endif
                    @else
                        @if(isset($nilai))
                            {{ $nilai->nilai_avg }}
                        @else
                            N/A
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


