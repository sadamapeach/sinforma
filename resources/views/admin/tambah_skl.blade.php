@extends('index_admin')
@section('title', 'SKL')

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
            <br>
            <h1 class="text-l mb-5 font-semibold leading-tight tracking-tight text-gray-900 md:text-xl dark:text-white">
                Penerbitan Surat Keterangan Lulus (SKL)
            </h1>
            <form action="{{ route('tambah_skl') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="id_mhs" class="block text-sm font-medium text-gray-600">Pilih Mahasiswa:</label>
                <select name="id_mhs" id="id_mhs" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" disabled selected>Pilih Mahasiswa</option>
                    @foreach ($mahasiswas as $mahasiswa)
                        <option value="{{ $mahasiswa->id_mhs }}">{{ $mahasiswa->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="file_skl" class="block text-sm font-medium text-gray-600">Unggah File SKL:</label>
                <input type="file" name="file_skl" id="file_skl" class="mt-1 block w-full">
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mx-auto">Terbitkan SKL</button>
            </div>
        </form>
        </div>
    </div>
</body>
@endsection
