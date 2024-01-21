@extends('index_admin')
@section('title', 'Daftar Mahasiswa')

@section('isihalaman')
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>

        .button-link {
            display: inline-block;
            padding: 6px 10px;
            margin: 4px 0;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border: 1px solid #ccc; 
            border-radius: 4px;
            color: #666; 
            background-color: #f0f0f0;
            transition: background-color 0.3s, color 0.3s;
        }

        .button-link:hover {
            background-color: #ccc; 
            color: #fff;
        }
    </style>
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
            Daftar Mahasiswa Penerbitan SKL
        </h1>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white dark:bg-gray-900">
                <form class="flex items-center" action="{{ route('search_mhs') }}" method="GET">   
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
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Instansi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jurusan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($mhsData)
                            @foreach ($mhsData as $mhs)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover-bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{ $mhs['nama'] }}
                                    </td>    
                                    <td class="px-6 py-4">
                                        {{ $mhs['instansi'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $mhs['jurusan'] }}
                                    </td>
                                    <td>
                                        <div class="button-container">
                                            <a href="{{ route('lihat_nilai', ['id_mhs' => $mhs['id_mhs'] ?? null]) }}" class="text-grey-400 hover:text-blue-100 button-link">
                                                <i class="material-icons-outlined text-base"></i> Lihat Nilai
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($mhs['skl'])
                                            <form action="#" method="GET">
                                                @csrf
                                                <button type="submit" class="text-sm font-medium text-white bg-green-400 rounded-lg border border-green-400 px-2 py-1 focus:outline-none focus:ring-2 focus:ring-green-300 hover:bg-green-500">
                                                    Lihat SKL
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('view_tambah_skl', ['id_mhs' => $mhs['id_mhs'] ?? null]) }}" method="GET" enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="text-sm font-medium text-white rounded-lg border px-2 py-1 focus:outline-none bg-blue-500 hover:bg-blue-200">
                                                    Tambah SKL
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
@endsection