@extends('index_admin')
@section('title', 'Penerbitan SKL')

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

            <form action="{{ route('tambah_skl', ['id_mhs' => $mahasiswa->id_mhs]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="flex items-center justify-center w-full">
                    <label for="file_skl" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="file_skl" name="file_skl" type="file" class="hidden" />
                    </label>
                </div> 

                {{-- <div class="mb-4">
                    <label for="file_skl" class="block text-sm font-medium text-gray-600">Unggah File SKL:</label>
                    <input type="file" name="file_skl" id="file_skl" class="mt-1 block w-full">
                </div> --}}

                <div class="mt-4 text-center">
                    <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mx-auto">Terbitkan SKL</button>
                </div>
            </form>

        </div>
    </div>
</body>
@endsection
