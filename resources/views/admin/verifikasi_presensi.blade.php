@extends('index_admin')
@section('title', 'Verifikasi Presensi')

@section('isihalaman')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    <script>
        function sortTable(columnIndex) {
            const table = document.querySelector('.sortable-table');
            const rows = Array.from(table.querySelectorAll('tbody tr'));

            const isAscending = table.classList.contains('sorted-asc');
            const sortMultiplier = isAscending ? 1 : -1;

            rows.sort((rowA, rowB) => {
                const cellA = rowA.cells[columnIndex].textContent.trim().toLowerCase();
                const cellB = rowB.cells[columnIndex].textContent.trim().toLowerCase();
                return sortMultiplier * cellA.localeCompare(cellB);
            });

            table.querySelector('tbody').innerHTML = '';

            rows.forEach(row => {
                table.querySelector('tbody').appendChild(row);
            });

            table.classList.toggle('sorted-asc');
        }
    </script>
</head>

<body>
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        @if (session('success'))
            <div class="p-4 mr-2 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <br>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            <br>
        @endif

        <h1 class="text-2xl mb-5 font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Verifikasi Presensi
        </h1>

        <form class="flex items-center" action="{{ route('search_presensi') }}" method="GET">   
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                </div>
                <input type="text" name="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Nama/Instansi/Jurusan" required>
            </div>
            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </form>
        
        <form class="flex items-center" action="{{ route('filter_presensi') }}" method="GET">
            <div class="relative mt-1">
                <select name="filter" id="filter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    <option value="all">Semua Status</option>
                    <option value="verified" {{ request('filter') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="unverified" {{ request('filter') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                </select>
            </div>
            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Filter
            </button>

        </form>

        <br>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if(!$verifikasiPresensiData)
                <div class="pb-4 bg-white dark:bg-gray-900">
                    <p class="mt-2 ml-2 text-base text-gray-500 dark:text-gray-400">Tidak ada data verifikasi presensi yang perlu diverifikasi</p>
                </div>
            @else
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 sortable-table">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center" onclick="sortTable(1)">
                            Nama
                            <button class="sort-button ml-2">
                                    <span class="text-gray-800">&#8693;</span>
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center" onclick="sortTable(2)">
                            Instansi
                            <button class="sort-button ml-2">
                                    <span class="text-gray-800">&#8693;</span>
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center" onclick="sortTable(3)">
                            Jurusan
                            <button class="sort-button ml-2">
                                    <span class="text-gray-800">&#8693;</span>
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">Foto</th>
                        <th scope="col" class="px-6 py-3 text-center" onclick="sortTable(4)">
                            Waktu
                            <button class="sort-button ml-2">
                                    <span class="text-gray-800">&#8693;</span>
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center" onclick="sortTable(5)">
                            Ket
                            <button class="sort-button">
                                    <span class="text-gray-800">&#8693;</span>
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center" onclick="sortTable(6)">
                            Status
                            <button class="sort-button ml-2">
                                    <span class="text-gray-800">&#8693;</span>
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($verifikasiPresensiData as $verifikasiPresensi)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover-bg-gray-600">
                        <td class="px-6 py-4">{{ $verifikasiPresensi->mahasiswa->nama }}</td>
                        <td class="px-6 py-4">{{ $verifikasiPresensi->mahasiswa->instansi }}</td>
                        <td class="px-6 py-4">{{ $verifikasiPresensi->mahasiswa->jurusan }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ asset('storage/' . $verifikasiPresensi->foto) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat Gambar</a>
                        </td>
                        <td class="px-6 py-4 text-center">{{ $verifikasiPresensi->tanggal }}</td>
                        <td class="px-6 py-4 text-center">{{ $verifikasiPresensi->keterangan }}</td>
                        <td class="px-6 py-4 text-center">{{ $verifikasiPresensi->status }}</td>
                        <td class="text-center">
                        <form action="{{ route('verif_presensi', ['id_mhs' => $verifikasiPresensi->mahasiswa->id_mhs]) }}" method="GET">
                            @csrf
                            @if ($verifikasiPresensi->status !== 'Verified')
                                <button type="submit" class="text-center text-sm font-medium text-white bg-green-400 rounded-lg border border-green-400 px-2 py-1 focus:outline-none focus:ring-2 focus:ring-green-300 hover:bg-green-500">
                                    Verifikasi
                                </button>
                            @else
                                <button type="button" class="text-center text-sm font-medium text-gray-500 bg-gray-300 rounded-lg border border-gray-300 px-2 py-1 cursor-not-allowed" disabled>
                                    Verified
                                </button>
                            @endif
                        </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
</body>
@endsection