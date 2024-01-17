@extends('index_mentor')
@section('title', 'Progress Mahasiswa')

@section('isihalaman')
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

    <a href="{{ route('daftar_mhs_mentor') }}" class="text-blue-600 dark:text-blue-500 hover:underline mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
        <!-- Informasi Mahasiswa -->
        <div class="flex flex-col items-center mb-6">
            <h1 class="text-l mb-5 font-semibold leading-tight tracking-tight text-gray-900 md:text-xl dark:text-white">
                    Progress Magang 
            </h1>
            <div class="relative w-20 h-20 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <img src="{{ $foto }}" alt="user photo" class="w-20 h-20 object-cover" />
            </div>
            <br>
            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $mahasiswa->nama }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $mahasiswa->instansi }} | {{ $mahasiswa->jurusan }} | {{ $mahasiswa->status }}</p>
        </div>

       <!-- Tabel Progress Magang -->
        @if($progressMagang->isEmpty())
            <div class="pb-4 bg-white dark:bg-gray-900">
                <p class="mt-2 ml-2 text-base text-gray-500 dark:text-gray-400">Belum ada progress magang yang diisikan</p>
            </div>
        @else
            <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="py-2 px-4 border-b">Deskripsi</th>
                        <th class="py-2 px-4 border-b">Tanggal</th>
                        <th class="py-2 px-4 border-b">Scan File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($progressMagang as $progress)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $progress->deskripsi }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $progress->tanggal }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ asset('storage/' . $progress->scan_file) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400 inline-flex items-center justify-center">Lihat file</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        @if (session('success'))
            <div class="p-4 mr-2 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>
</div>

</body>
@endsection