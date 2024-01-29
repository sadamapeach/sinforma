@extends('index_admin')
@section('title', 'Edit Event')

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

            <a href="{{ route('view_berita') }}" class="text-blue-600 dark:text-blue-500 hover:underline mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <br>

            <h1
                class="text-l text-center mb-5 font-semibold leading-tight tracking-tight text-gray-900 md:text-xl dark:text-white">
                Edit Event
            </h1>

            <form action="{{ route('update_berita', [$berita->id_berita]) }}" method="POST" enctype="multipart/form-data">
                @csrf                
                <div class="form-group">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama:</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $berita->nama) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('nama')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <div>
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unggah Gambar:</label>
                    <input type="file" name="gambar" id="gambar" class="mt-1 block w-full">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mx-auto">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</body>
@endsection
