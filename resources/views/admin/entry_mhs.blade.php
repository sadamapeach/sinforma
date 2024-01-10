@extends('index_admin')
@section('title', 'Tambah Mahasiswa')

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
                Tambah Data Mahasiswa
            </h1>
            <form class="space-y-4 md:space-y-6" method="POST" autocomplete="on" action="{{ route('store_mhs') }}" >
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="form-group">
                        <label for="id_mhs" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID:</label>
                        <input type="text" id="id_mhs" name="id_mhs" value="{{ old('id_mhs') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('id_mhs')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama:</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('nama')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="form-group">
                        <label for="instansi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instansi:</label>
                        <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('instansi')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan:</label>
                        <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('jurusan')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="form-group">
                        <label for="mulai_magang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mulai Magang:</label>
                        <input type="date" id="mulai_magang" name="mulai_magang" value="{{ old('mulai_magang') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('mulai_magang')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="selesai_magang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selesai Magang:</label>
                        <input type="date" id="selesai_magang" name="selesai_magang" value="{{ old('selesai_magang') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('selesai_magang')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="mentor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mentor:</label>
                    <select id="mentor" name="mentor" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Mentor</option>
                        @foreach ($mentor as $mentorItem)
                            <option value="{{ $mentorItem->nip }}" {{ old('mentor') == $mentorItem->nip ? 'selected' : '' }}>
                                {{ $mentorItem->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('mentor')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <div>
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                </div>

                <div class="m-auto">
                    <button type="submit" name="submit" value="generate" class="mr-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Buat Akun
                    </button>
                    <a href="{{ route('entry_mhs') }}" class="mr-auto text-white bg-gray-400 hover:bg-gray-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-400 dark:hover:bg-gray-500 focus:outline-none dark:focus:ring-gray-600">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
