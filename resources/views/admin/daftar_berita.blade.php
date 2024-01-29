@extends('index_admin')
@section('title', 'Daftar Event')

@section('isihalaman')
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
<div class="p-4 sm:ml-64">
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        @if (session('success'))
        <div class="p-4 mr-2 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <br>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            <br>
        @endif
        <h1
            class="text-2xl mb-5 font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Daftar Event Mahasiswa Magang
        </h1>
        <div class="flex mb-4">
            <a href="{{ route('view_tambah_berita') }}" class="p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+ Tambah Event</a>
        </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Gambar
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($berita as $event)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover-bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $event->nama }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('storage/' . $event->gambar) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat Gambar</a>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('view_edit_berita', ['id_berita' => $event['id_berita'] ?? null]) }}" class="text-center text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('delete_berita', [$event->id_berita]) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus event ini?')" class="text-red-600 hover:text-red-900 ml-2">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            
    </div>
</div>
</body>
@endsection