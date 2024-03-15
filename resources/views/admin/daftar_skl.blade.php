@extends('index_admin')
@section('title', 'Daftar Mahasiswa')

@section('isihalaman')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    <script>
        function sortTable(columnIndex) {
            const table = document.querySelector('.sortable-table');
            const rows = Array.from(table.querySelectorAll('tbody tr'));

            const isAscending = table.classList.contains('sorted-asc');
            const sortMultiplier = isAscending ? 1 : -1;

            rows.sort((rowA, rowB) => {
                const cellA = rowA.cells[columnIndex].textContent.trim().toLowerCase();
                const cellB = rowB.cells[columnIndex].textContent.trim().toLowerCase();
                return sortMultiplier * cellA.localeCompare(cellB);
            });

            table.querySelector('tbody').innerHTML = '';

            rows.forEach(row => {
                table.querySelector('tbody').appendChild(row);
            });

            table.classList.toggle('sorted-asc');
        }
    </script>

    <style>
        .d-none {
            display: none;
        }
    </style>
</head>

<body class="h-screen">
    <div class="p-4 sm:ml-64">
        @if (session('success'))
            <div id="notification-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-900 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-900 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

            <script>
                // Hide success notification after 5000 milliseconds (5 seconds)
                setTimeout(function() {
                    document.getElementById('notification-success').style.display = 'none';
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div id="notification-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-900 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-900 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

            <script>
                // Hide error notification after 5000 milliseconds (5 seconds)
                setTimeout(function() {
                    document.getElementById('notification-error').style.display = 'none';
                }, 3000);
            </script>
        @endif

        <nav class="bg-zinc-100 border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg">
            {{-- Welcome User --}}
            <div class="flex p-2.5"> 
                <p class="self-center text-sm font-semibold whitespace-nowrap text-black dark:text-white ml-1">Daftar Penerbitan SKL Mahasiswa Magang</p>
                {{-- Icon --}}
                <div class="ml-auto flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <!-- Dropdown menu -->
                    <span><button type="button" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 px-2" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-start">
                        <span class="sr-only">Open user menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-black dark:fill-white">
                            <path fill-rule="evenodd" d="M6.955 1.45A.5.5 0 0 1 7.452 1h1.096a.5.5 0 0 1 .497.45l.17 1.699c.484.12.94.312 1.356.562l1.321-1.081a.5.5 0 0 1 .67.033l.774.775a.5.5 0 0 1 .034.67l-1.08 1.32c.25.417.44.873.561 1.357l1.699.17a.5.5 0 0 1 .45.497v1.096a.5.5 0 0 1-.45.497l-1.699.17c-.12.484-.312.94-.562 1.356l1.082 1.322a.5.5 0 0 1-.034.67l-.774.774a.5.5 0 0 1-.67.033l-1.322-1.08c-.416.25-.872.44-1.356.561l-.17 1.699a.5.5 0 0 1-.497.45H7.452a.5.5 0 0 1-.497-.45l-.17-1.699a4.973 4.973 0 0 1-1.356-.562L4.108 13.37a.5.5 0 0 1-.67-.033l-.774-.775a.5.5 0 0 1-.034-.67l1.08-1.32a4.971 4.971 0 0 1-.561-1.357l-1.699-.17A.5.5 0 0 1 1 8.548V7.452a.5.5 0 0 1 .45-.497l1.699-.17c.12-.484.312-.94.562-1.356L2.629 4.107a.5.5 0 0 1 .034-.67l.774-.774a.5.5 0 0 1 .67-.033L5.43 3.71a4.97 4.97 0 0 1 1.356-.561l.17-1.699ZM6 8c0 .538.212 1.026.558 1.385l.057.057a2 2 0 0 0 2.828-2.828l-.058-.056A2 2 0 0 0 6 8Z" clip-rule="evenodd" />
                        </svg>  
                    </button></span>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">Customize Mode</span>
                            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">
                                <div class="flex items-center mt-1">
                                {{-- Light --}}
                                <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="black" class="w-4 h-4 fill-black dark:fill-white">
                                    <path d="M8 1a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 8 1ZM10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM12.95 4.11a.75.75 0 1 0-1.06-1.06l-1.062 1.06a.75.75 0 0 0 1.061 1.062l1.06-1.061ZM15 8a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 15 8ZM11.89 12.95a.75.75 0 0 0 1.06-1.06l-1.06-1.062a.75.75 0 0 0-1.062 1.061l1.061 1.06ZM8 12a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 8 12ZM5.172 11.89a.75.75 0 0 0-1.061-1.062L3.05 11.89a.75.75 0 1 0 1.06 1.06l1.06-1.06ZM4 8a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 4 8ZM4.11 5.172A.75.75 0 0 0 5.173 4.11L4.11 3.05a.75.75 0 1 0-1.06 1.06l1.06 1.06Z" />
                                </svg></span>

                                {{-- Toogle --}}
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="" class="sr-only peer" id="toggle">
                                    <div class="w-9 h-5 bg-zinc-300 peer-focus:outline-none peer-focus peer-focus dark:peer-focus rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-purple-400 toggle-circle"></div>
                                </label>

                                {{-- Dark --}}
                                <span class="ml-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-black dark:fill-white">
                                    <path d="M14.438 10.148c.19-.425-.321-.787-.748-.601A5.5 5.5 0 0 1 6.453 2.31c.186-.427-.176-.938-.6-.748a6.501 6.501 0 1 0 8.585 8.586Z" />
                                </svg></span>
                                </div>
                            </span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                        <li class="w-full hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-red-700  hover:text-red-400 dark:text-red-500 dark:hover:text-red-300">Sign out</button>
                            </form>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="grid grid-cols-3 gap-3 my-3">
            {{-- Jumlah Total Mahasiswa --}}
            <div class="flex bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow">
                <div class="self-center p-3 w-full text-center">
                    <h1 class="text-xl font-bold text-yellow-400 dark:text-yellow-300">{{ $totalMahasiswa }}</h1>
                    <p class="text-xs font-semibold text-black dark:text-white">Total Mahasiswa Magang</p>
                </div>
            </div>

            {{-- Penilaian: Sudah --}}
            <div class="flex bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow">
                <div class="self-center p-3 w-full text-center">
                    <h1 class="text-xl font-bold text-blue-700 dark:text-blue-500">{{ count($skl1) }}</h1>
                    <p class="text-xs font-semibold text-black dark:text-white">SKL Sudah Diterbitkan</p>
                </div>
            </div>

            {{-- Penilaian: Belum --}}
            <div class="flex bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow">
                <div class="self-center p-3 w-full text-center">
                    <h1 class="text-xl font-bold text-pink-700 dark:text-pink-500">{{ count($skl2) }}</h1>
                    <p class="text-xs font-semibold text-black dark:text-white">SKL Belum Diterbitkan</p>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow">
            <div class="flex items-center mb-4"> 
                {{-- Search --}}
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-500">
                            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                        </svg>                          
                    </div>
                    <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Mahasiswa" style="width: 325px">
                </div>
            </div>

            {{-- Tabel --}}
            <div class="relative shadow md:rounded">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sortable-table overflow-y-auto">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400 border border-gray-300 dark:border-black">
                        <tr>
                            <th scope="col" class="px-4 py-4 w-12">
                                No
                            </th>
                            <th scope="col" class="px-4 py-4 w-20" onclick="sortTable(1)">
                                ID
                                <button class="sort-button ml-1">
                                    <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                </button>
                            </th>
                            <th scope="col" class="px-4 py-4 w-52" onclick="sortTable(2)">
                                Nama
                                <button class="sort-button ml-1">
                                    <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                </button>
                            </th>
                            <th scope="col" class="px-4 py-4 w-40" onclick="sortTable(3)">
                                Jurusan
                                <button class="sort-button ml-1">
                                    <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                </button>
                            </th>
                            <th scope="col" class="px-4 py-4 w-40" onclick="sortTable(4)">
                                Instansi
                                <button class="sort-button ml-1">
                                    <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                </button>
                            </th>
                            <th scope="col" class="px-4 py-4 w-16 text-center">
                                Nilai
                            </th>
                            <th scope="col" class="px-4 py-4 w-16 text-center">
                                SKL
                            </th>
                            <th scope="col" class="px-4 py-4 w-24 text-center">
                                Aksi SKL
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-gray-400 overflow-y-auto">
                        @if ($mhsData)
                            @foreach ($mhsData as $index => $mhs)
                                <tr class="text-xs bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-300 dark:border-black">
                                    <td class="px-4 py-4 text-center w-12">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-4 w-20">
                                        {{ $mhs->id_mhs }}
                                    </td>
                                    <td class="flex items-center px-4 py-4 w-52">
                                        <img class="w-7 h-7 rounded-full" src="{{ asset('storage/' . $mhs->foto) }}" alt="Jese image">
                                        <div class="ps-3">
                                            {{ $mhs->nama }}
                                        </div>  
                                    </td>
                                    <td class="px-4 py-4 w-40">
                                        {{ $mhs->jurusan }}
                                    </td>
                                    <td class="px-4 py-4 w-40">
                                        {{ $mhs->instansi }}
                                    </td>
                                    <td class="px-4 py-4 w-16 text-center">
                                        <a href="{{ route('lihat_nilai', ['id_mhs' => $mhs['id_mhs'] ?? null]) }}" class="bg-green-100 text-green-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300" style="font-size: 10px">Lihat</a>
                                    </td>
                                    <td class="px-4 py-4 w-16">
                                        @if ($mhs['skl'])
                                            <form action="{{ asset('storage/' . $mhs['skl']->file_skl) }}" method="GET" enctype="multipart/form-data" class="text-center">
                                                @csrf
                                                <button type="botton" class="bg-blue-100 text-blue-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300" style="font-size: 10px">
                                                    Sudah
                                                </button>
                                            </form>
                                        @else
                                            <div class="text-center">
                                                <button data-modal-target="upload-modal-{{ $mhs->id_mhs }}" data-modal-toggle="upload-modal-{{ $mhs->id_mhs }}" type="submit" class="bg-pink-100 text-pink-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300" style="font-size: 10px">
                                                    Belum
                                                </button>
                                            </div>
                                        @endif

                                        {{-- Pop Up --}}
                                        @if (!$mhs['skl'])
                                            <!-- Modal untuk Upload SKL -->
                                            <div id="upload-modal-{{ $mhs->id_mhs }}" tabindex="-1" aria-hidden="true" class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ml-24" data-modal="upload-modal-{{ $mhs->id_mhs }}">
                                                <div class="modal-box relative p-4 w-full max-w-md max-h-full">
                                                    {{-- Modal Content --}}
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="modal-header flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="modal-title text-sm font-semibold text-gray-900 dark:text-white">
                                                                Penerbitan Surat Keterangan Lulus (SKL)
                                                            </h3>
                                                            <button class="btn btn-clear text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="upload-modal-{{ $mhs->id_mhs }}" data-modal-hide="upload-modal-{{ $mhs->id_mhs }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                    <div class="modal-body p-4 md:p-5">
                                                        <form action="{{ route('tambah_skl', ['id_mhs' => $mhs->id_mhs]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-control flex items-center justify-center w-full">
                                                                <label for="file-skl-{{ $mhs->id_mhs }}" class="label flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600" id="border-{{ $mhs->id_mhs }}">
                                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                                        <svg id="icon-{{ $mhs->id_mhs }}" class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                                        </svg>
                                                                        <p id="header-{{ $mhs->id_mhs }}" class="label-text mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                                                                        <p id="file-name-{{ $mhs->id_mhs }}" class="text-xs text-gray-500 dark:text-gray-400">format: .PDF dengan ukuran maksimal 10 MB</p>
                                                                    </div>                                                                   
                                                                    <input type="file" name="file_skl" id="file-skl-{{ $mhs->id_mhs }}" class="input input-bordered hidden" onchange="displayFileName('{{ $mhs->id_mhs }}')">
                                                                </label>
                                                            </div>
                                                            <div class="flex form-control mt-4">
                                                                {{-- Simpan --}}
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700">Simpan</button>
                                                                {{-- Cancel --}}
                                                                <button type="button" onclick="resetUpload('{{ $mhs->id_mhs }}')" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 w-24 text-center">
                                        @if ($mhs['skl'])
                                            {{-- Edit --}}
                                            <div class="flex items-center ml-3">
                                                <button data-modal-target="update-modal-{{ $mhs->id_mhs }}" data-modal-toggle="update-modal-{{ $mhs->id_mhs }}" type="submit" data-tooltip-target="tooltip-edit-hover-{{ $loop->index }}" data-tooltip-trigger="hover">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 mr-3">
                                                        <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                                        <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                                                    </svg>
                                                </button>
                                                <div id="tooltip-edit-hover-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700" style="font-size: 10px">
                                                    Edit
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div> 

                                                {{-- Delete --}}
                                                <button class="ml-0.5" data-modal-target="delete-modal-{{ $mhs->id_mhs }}" data-modal-toggle="delete-modal-{{ $mhs->id_mhs }}" data-tooltip-target="tooltip-delete-hover-{{ $loop->index }}" data-tooltip-trigger="hover">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5">
                                                        <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>   
                                                <div id="tooltip-delete-hover-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700" style="font-size: 10px">
                                                    Delete
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>

                                                {{-- Pop Up Delete --}}
                                                <div id="delete-modal-{{ $mhs->id_mhs }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ml-32">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $mhs->id_mhs }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-4 md:p-5 text-center">
                                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                </svg>
                                                                <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin menghapus SKL ini?</h3>
                                                                <div class="flex justify-center">
                                                                    <form method="POST" action="{{ route('delete_skl', [$mhs->id_mhs]) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button data-modal-hide="delete-modal-{{ $mhs->id_mhs }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-xs inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                            Ya
                                                                        </button>
                                                                    </form>
                                                                    <button data-modal-hide="delete-modal-{{ $mhs->id_mhs }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-xs font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pop Up Edit -->
                                            <div id="update-modal-{{ $mhs->id_mhs }}" tabindex="-1" aria-hidden="true" class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ml-24" data-modal="update-modal-{{ $mhs->id_mhs }}">
                                                <div class="modal-box relative p-4 w-full max-w-md max-h-full">
                                                    {{-- Modal Content --}}
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="modal-header flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="modal-title text-sm font-semibold text-gray-900 dark:text-white">
                                                                Penerbitan Surat Keterangan Lulus (SKL)
                                                            </h3>
                                                            <button class="btn btn-clear text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="update-modal-{{ $mhs->id_mhs }}" data-modal-hide="upload-modal-{{ $mhs->id_mhs }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                    <div class="modal-body p-4 md:p-5">
                                                        <form action="{{ route('update_skl', ['id_mhs' => $mhs->id_mhs]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-control flex items-center justify-center w-full">
                                                                <label for="file-skl2-{{ $mhs->id_mhs }}" class="label flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600" id="border2-{{ $mhs->id_mhs }}">
                                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                                        <svg id="icon2-{{ $mhs->id_mhs }}" class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                                        </svg>
                                                                        <p id="header2-{{ $mhs->id_mhs }}" class="label-text mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                                                                        <p id="file-name2-{{ $mhs->id_mhs }}" class="text-xs text-gray-500 dark:text-gray-400">format: .PDF dengan ukuran maksimal 10 MB</p>
                                                                    </div>                                                                   
                                                                    <input type="file" name="file_skl" id="file-skl2-{{ $mhs->id_mhs }}" class="input input-bordered hidden" onchange="displayFileName2('{{ $mhs->id_mhs }}')">
                                                                </label>
                                                            </div>
                                                            <div class="flex form-control mt-4">
                                                                {{-- Simpan --}}
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700">Simpan</button>
                                                                {{-- Cancel --}}
                                                                <button type="button" onclick="resetUpload2('{{ $mhs->id_mhs }}')" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Edit --}}
                                            <button class="text-gray-400 dark:text-gray-500 pointer-events-none" aria-disabled="true" tabindex="-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 mr-3">
                                                    <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                                    <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                                                </svg>  
                                            </button>
                                            

                                            {{-- Delete --}}
                                            <button class="text-gray-400 dark:text-gray-500 pointer-events-none" aria-disabled="true" tabindex="-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5">
                                                    <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                                </svg>
                                            </button>   
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
            <p class="mt-2 text-gray-500 dark:text-gray-400" style="font-size: 9px">* Hanya menampilkan daftar mahasiswa yang sudah diterbitkan nilainya</p>
        </div>
    </div>

    <script>
        const search = document.getElementById("search");
        const items = document.querySelectorAll("tbody tr");

        search.addEventListener("input", (e) => searchData(e.target.value));

        function searchData(search) {
            items.forEach((item) => {
                if (item.innerText.toLowerCase().includes(search.toLowerCase())) {
                    item.classList.remove("d-none");
                } else {
                    item.classList.add("d-none");
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi modal Flowbite
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                new mdb.Modal(modal);
            });
        });

        function displayFileName(id) {
            const fileInput = document.getElementById(`file-skl-${id}`);
            const fileNameDisplay = document.getElementById(`file-name-${id}`);
            const fileNameHeader = document.getElementById(`header-${id}`);
            var svgElement = document.getElementById(`icon-${id}`);
            // var labelElement = document.getElementById(`border-${id}`);

            // Mendapatkan tema saat ini dari CSS menggunakan window.getComputedStyle (Tambahan)
            // const currentTheme = window.getComputedStyle(document.documentElement).getPropertyValue('--theme');

            if (fileInput.files.length > 0) {
                fileNameDisplay.innerHTML = `Nama file: <span style="font-weight: bold; color: green;">${fileInput.files[0].name}</span>`;
                fileNameHeader.innerHTML = '<span class="font-semibold" style="color: green">Berhasil</span> mengupload file!';
                svgElement.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 50 50" fill="green"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" /></svg>';

                // labelElement.style.borderColor = 'green';
                // labelElement.style.backgroundColor = '#dcfce7';

                // labelElement.style.borderColor = currentTheme === 'light' ? 'var(--light-border-color)' : 'var(--dark-border-color)';
                // labelElement.style.backgroundColor = currentTheme === 'light' ? 'var(--light-background-color)' : 'var(--dark-background-color)';
            } else {
                fileNameDisplay.textContent = 'format: .PDF dengan ukuran maksimal 10 MB';
            }
        }

        function resetUpload(id) {
            const fileInput = document.getElementById(`file-skl-${id}`);
            const fileNameDisplay = document.getElementById(`file-name-${id}`);
            const fileNameHeader = document.getElementById(`header-${id}`);
            var svgElement = document.getElementById(`icon-${id}`);
            // var labelElement = document.getElementById(`border-${id}`);

            // Mendapatkan tema saat ini dari CSS menggunakan window.getComputedStyle (Tambahan)
            // const currentTheme = window.getComputedStyle(document.documentElement).getPropertyValue('--theme');
            // labelElement.style.borderColor = currentTheme === 'light' ? 'var(--light-border-color)' : 'var(--dark-border-color)';
            // labelElement.style.backgroundColor = currentTheme === 'light' ? 'var(--light-background-color)' : 'var(--dark-background-color)';

            // labelElement.style.borderColor = '#d4d4d8';
            // labelElement.style.backgroundColor = '#f4f4f5';

            fileInput.value = ''; // Clear file input
            fileNameDisplay.textContent = 'format: .PDF dengan ukuran maksimal 10 MB';
            fileNameHeader.innerHTML = '<span class="font-semibold">Click to upload</span>';
            svgElement.innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>';
        }

        function displayFileName2(id) {
            const fileInput = document.getElementById(`file-skl2-${id}`);
            const fileNameDisplay = document.getElementById(`file-name2-${id}`);
            const fileNameHeader = document.getElementById(`header2-${id}`);
            var svgElement = document.getElementById(`icon2-${id}`);
            // var labelElement = document.getElementById(`border2-${id}`);

            // Mendapatkan tema saat ini dari CSS menggunakan window.getComputedStyle (Tambahan)
            // const currentTheme = window.getComputedStyle(document.documentElement).getPropertyValue('--theme');

            if (fileInput.files.length > 0) {
                fileNameDisplay.innerHTML = `Nama file: <span style="font-weight: bold; color: green;">${fileInput.files[0].name}</span>`;
                fileNameHeader.innerHTML = '<span class="font-semibold" style="color: green">Berhasil</span> mengupload file!';
                svgElement.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 50 50" fill="green"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" /></svg>';

                // labelElement.style.borderColor = 'green';
                // labelElement.style.backgroundColor = '#dcfce7';

                // labelElement.style.borderColor = currentTheme === 'light' ? 'var(--light-border-color)' : 'var(--dark-border-color)';
                // labelElement.style.backgroundColor = currentTheme === 'light' ? 'var(--light-background-color)' : 'var(--dark-background-color)';
            } else {
                fileNameDisplay.textContent = 'format: .PDF dengan ukuran maksimal 10 MB';
            }
        }

        function resetUpload2(id) {
            const fileInput = document.getElementById(`file-skl2-${id}`);
            const fileNameDisplay = document.getElementById(`file-name2-${id}`);
            const fileNameHeader = document.getElementById(`header2-${id}`);
            var svgElement = document.getElementById(`icon2-${id}`);
            // var labelElement = document.getElementById(`border2-${id}`);

            // Mendapatkan tema saat ini dari CSS menggunakan window.getComputedStyle (Tambahan)
            // const currentTheme = window.getComputedStyle(document.documentElement).getPropertyValue('--theme');
            // labelElement.style.borderColor = currentTheme === 'light' ? 'var(--light-border-color)' : 'var(--dark-border-color)';
            // labelElement.style.backgroundColor = currentTheme === 'light' ? 'var(--light-background-color)' : 'var(--dark-background-color)';

            // labelElement.style.borderColor = '#d4d4d8';
            // labelElement.style.backgroundColor = '#f4f4f5';

            fileInput.value = ''; // Clear file input
            fileNameDisplay.textContent = 'format: .PDF dengan ukuran maksimal 10 MB';
            fileNameHeader.innerHTML = '<span class="font-semibold">Click to upload</span>';
            svgElement.innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>';
        }
    </script>
</body>
@endsection