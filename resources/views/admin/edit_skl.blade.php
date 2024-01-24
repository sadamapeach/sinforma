@extends('index_admin')
@section('title', 'Edit SKL')

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
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <a href="{{ route('skl_mhs') }}" class="text-blue-600 dark:text-blue-500 hover:underline mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <br>

            <!-- Informasi Mahasiswa -->
            <h1 class="text-l text-center mb-5 font-semibold leading-tight tracking-tight text-gray-900 md:text-xl dark:text-white">
                Penerbitan Surat Keterangan Lulus (SKL) 
            </h1>
            <div class="flex flex-col items-center mb-6">
                <div class="relative w-20 h-20 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <img src="{{ $foto }}" alt="user photo" class="w-20 h-20 object-cover" />
                </div>
                <br>
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $mahasiswa->nama }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $mahasiswa->instansi }} | {{ $mahasiswa->jurusan }} </p>
            </div>

            <form action="{{ route('update_skl', ['id_mhs' => $mahasiswa->id_mhs]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file_skl" class="block text-sm font-medium text-gray-600">Unggah File SKL Baru:</label>
                    <input type="file" name="file_skl" id="file_skl" class="mt-1 block w-full">
                </div>
                <div class="mt-4 text-center">
                    <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mx-auto">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</body>
@endsection
