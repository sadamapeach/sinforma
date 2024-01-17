@extends('index_mentor')
@section('title', 'Presensi Mahasiswa')

@section('isihalaman')
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
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
            Presensi Mahasiswa
        </h1>
        <a href="{{ route('daftar_mhs_mentor') }}" class="text-blue-600 dark:text-blue-500 hover:underline mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        
        <br>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if(!$PresensiData)
                <div class="pb-4 bg-white dark:bg-gray-900">
                    <p class="mt-2 ml-2 text-base text-gray-500 dark:text-gray-400">Belum pernah mengisikan presensi</p>
                </div>
            @else
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Instansi</th>
                            <th scope="col" class="px-6 py-3">Jurusan</th>
                            <th scope="col" class="px-6 py-3">Foto</th>
                            <th scope="col" class="px-6 py-3">Waktu</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(is_object($PresensiData))
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover-bg-gray-600">
                                <td class="px-6 py-4">{{ $PresensiData->mahasiswa->id_mhs }}</td>
                                <td class="px-6 py-4">{{ $PresensiData->mahasiswa->nama }}</td>
                                <td class="px-6 py-4">{{ $PresensiData->mahasiswa->instansi }}</td>
                                <td class="px-6 py-4">{{ $PresensiData->mahasiswa->jurusan }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ asset('storage/' . $PresensiData->foto) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat Gambar</a>
                                </td>
                                <td class="px-6 py-4">{{ $PresensiData->tanggal }}</td>
                                <td class="px-6 py-4">{{ $PresensiData->status }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
</body>
@endsection
