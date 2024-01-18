@extends('index_mentor')
@section('title', 'Penilaian')

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
        <h1 class="text-l text-center mb-5 font-semibold leading-tight tracking-tight text-gray-900 md:text-xl dark:text-white">
            Penilaian Magang 
        </h1>
        <div class="flex flex-col items-center mb-6">
            <div class="relative w-20 h-20 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <img src="{{ $foto }}" alt="user photo" class="w-20 h-20 object-cover" />
            </div>
            <br>
            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $mahasiswa->nama }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $mahasiswa->instansi }} | {{ $mahasiswa->jurusan }} | {{ $mahasiswa->status }}</p>
        </div>

        <!-- Tabel Penilaian Magang -->
        <form action="{{ route('store_nilai', ['id_mhs' => $mahasiswa->id_mhs]) }}" method="post">
            @csrf
            <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="py-2 px-4 border-b">Nomor</th>
                        <th class="py-2 px-4 border-b">Kriteria Penilaian</th>
                        <th class="py-2 px-4 border-b">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">1</td>
                        <td class="py-2 px-4 border-b">Kedisiplinan dan Etika</td>
                        <td class="py-2 px-4 border-b">
                            <input type="number" name="nilai[]" class="w-full border rounded py-1 px-2">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">2</td>
                        <td class="py-2 px-4 border-b">Kemampuan Berkomunikasi dan Bekerja Sama</td>
                        <td class="py-2 px-4 border-b">
                            <input type="number" name="nilai[]" class="w-full border rounded py-1 px-2">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">3</td>
                        <td class="py-2 px-4 border-b">Pemahaman terhadap Permasalahan</td>
                        <td class="py-2 px-4 border-b">
                            <input type="number" name="nilai[]" class="w-full border rounded py-1 px-2">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">4</td>
                        <td class="py-2 px-4 border-b">Pengetahuan Teoritis dan Praktik</td>
                        <td class="py-2 px-4 border-b">
                            <input type="number" name="nilai[]" class="w-full border rounded py-1 px-2">
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Penilaian
            </button>
        </form>
        
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
