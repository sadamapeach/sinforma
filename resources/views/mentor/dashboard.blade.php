@extends('index_mentor')
@section('title', 'Dashboard')

@section('isihalaman')
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
        {{-- Reference Tailwind Flowbite --}}
        @vite(['resources/css/app.css','resources/js/app.js'])
    
        <script>
            function sortTable(columnIndex) {
                const table = document.querySelector('.sortable-table');
                const rows = Array.from(table.querySelectorAll('tbody tr'));
        
                // Simpan kolom Nomor ke dalam array sementara
                const originalOrder = rows.map((row, index) => ({ index, content: row.cells[0].textContent.trim() }));
        
                const isAscending = table.classList.contains('sorted-asc');
                const sortMultiplier = isAscending ? 1 : -1;
        
                // Sorting berdasarkan kolom yang diklik
                rows.sort((rowA, rowB) => {
                    const cellA = rowA.cells[columnIndex].textContent.trim().toLowerCase();
                    const cellB = rowB.cells[columnIndex].textContent.trim().toLowerCase();
                    return sortMultiplier * cellA.localeCompare(cellB);
                });
        
                // Mengembalikan kolom Nomor ke posisi semula
                originalOrder.forEach(({ index }) => {
                    table.querySelector('tbody').appendChild(rows[index]);
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

    <body class="font-poppins h-screen">  
        <div class="p-4 sm:ml-64">
            <nav class="bg-zinc-100 border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg">
                {{-- Welcome User --}}
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
                    <p class="self-center text-base font-semibold whitespace-nowrap text-black dark:text-white ml-2">Hello, {{ $mentor->nama }} 👋</p>
                    {{-- Icon --}}
                    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
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
        </div>
            
        <div class="px-4 sm:ml-64 -mt-1">
            <div class="flex space-x-3">
                {{-- Profile --}}
                <div class="block bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-2/5 h-52">
                    {{-- Header Card --}}
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-zinc-100 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                        <li class="me-2">
                            <p class="font-bold text-black dark:text-white py-1.5 px-6 text-base">Profile</p>
                        </li>
                    </ul>

                    {{-- Foto --}}
                    <figcaption class="flex items-center py-5 px-5">
                        <img class="rounded-full w-32 h-32" src="{{ Auth::user()->getImageURL() }}" alt="profile picture">
                        <div class="mx-4">
                            <div class="text-black dark:text-white text-sm font-bold">{{ $mentor->nama }}</div>
                            <div class="text-xs text-gray-700 dark:text-gray-400 mt-1">NIP. {{ $mentor->nip }}</div>
                            {{-- No.HP --}}
                            <div class="py-2.5 flex">
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                    <path fill-rule="evenodd" d="m3.855 7.286 1.067-.534a1 1 0 0 0 .542-1.046l-.44-2.858A1 1 0 0 0 4.036 2H3a1 1 0 0 0-1 1v2c0 .709.082 1.4.238 2.062a9.012 9.012 0 0 0 6.7 6.7A9.024 9.024 0 0 0 11 14h2a1 1 0 0 0 1-1v-1.036a1 1 0 0 0-.848-.988l-2.858-.44a1 1 0 0 0-1.046.542l-.534 1.067a7.52 7.52 0 0 1-4.86-4.859Z" clip-rule="evenodd" />
                                </svg></span>
                                <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $mentor->no_telepon }}</span>
                            </div>
                            {{-- Email --}}
                            <div class="flex">
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                    <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                    <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                </svg></span>
                                <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $mentor->email }}</span>
                            </div>
                        </div>
                    </figcaption>  
                </div>

                {{-- Jumlah --}}
                <div class="w-3/5 h-52">
                    <div class="grid grid-cols-3 gap-3">
                        <div class="grid grid-rows-2 gap-3">
                            {{-- Total Mahasiswa --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-yellow-200 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Total</h1>
                                    <h1 class="text-3xl font-bold text-yellow-400 dark:text-yellow-300">{{ $totalMahasiswa }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 9px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-2">
                                    <img class="h-14 w-14" src="assets/total.png" alt="image description">
                                </div>
                            </div>

                            {{-- Aktif --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-green-200 dark:bg-green-500 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Status: Aktif</h1>
                                    <h1 class="text-3xl font-bold text-green-700 dark:text-green-500">{{ $totalAktif }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-4">
                                    <img class="h-10 w-10" src="assets/aktif.png" alt="image description">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-rows-2 gap-3">
                            {{-- Tidak Aktif --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-red-200 dark:bg-pink-500 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Status: Tidak Aktif</h1>
                                    <h1 class="text-3xl font-bold text-pink-700 dark:text-pink-500">{{ $totalNonAktif }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-3">
                                    <img class="h-10 w-10" src="assets/tidak_aktif.png" alt="image description">
                                </div>
                            </div>
                            
                            {{-- Lulus --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-blue-200 dark:bg-blue-500 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Status: Lulus</h1>
                                    <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-500">{{ $totalLulus }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-3">
                                    <img class="h-10 w-10" src="assets/lulus.png" alt="image description">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-rows-2 gap-3">
                            {{-- Sudah Dinilai --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-gray-300 dark:bg-gray-500 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Penilaian: Sudah</h1>
                                    <h1 class="text-3xl font-bold text-gray-500 dark:text-gray-400">{{ count($nilai1) }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Aktif</p>
                                </div>
                                <div class="ml-auto self-center mr-3">
                                    <img class="h-12 w-12" src="assets/sudah_nilai.png" alt="image description">
                                </div>
                            </div>
                            
                            {{-- Belum Dinilai --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-purple-200 dark:bg-purple-500 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Penilaian: Belum</h1>
                                    <h1 class="text-3xl font-bold text-purple-700 dark:text-purple-500">{{ count($nilai2) }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Aktif</p>
                                </div>
                                <div class="ml-auto self-center mr-2">
                                    <img class="h-14 w-14" src="assets/belum_nilai.png" alt="image description">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-3">
                <div class="col-span-1">
                    <div class="mt-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-5" style="height: 260px">
                        <div class="flex flex-col text-center py-6">
                            <div class="text-sm font-bold text-black dark:text-white">Verifikasi Progress</div>
                            <div class=" text-gray-500 dark:text-gray-500" style="font-size: 10px">Berapa progress yang belum diverifikasi?</div>
                            <div class="my-3.5 self-center">
                                <img class="h-16 w-16 self-center" src="assets/skl_belum.png" alt="image description">
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-xs font-medium text-gray-700 dark:text-gray-400 text-center border-r border-gray-700 dark:border-gray-500">
                                    Belum <br> Diverifikasi
                                </div>
                                <div class="text-2xl font-bold dark:text-white">
                                    {{ count($progress) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Daftar Mahasiswa --}}
                <div class="col-span-3">
                    <div class="mt-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-5" style="height: 260px">
                        <div class="flex mb-3">
                            {{-- Search --}}
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-500">
                                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                                    </svg>                          
                                </div>
                                <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Realtime Progress">
                            </div>
                
                            {{-- Filter by Status --}}
                            <form action="{{ route('dashboard_mentor_filter') }}" method="GET" class="ml-auto mb-1 items-center">
                                <select id="status" name="status" class="p-1 text-xs text-gray-900 border ps-2.5 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="this.form.submit()">
                                    <option value="" selected>Status</option>
                                    <option value="">Semua Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                    <option value="Lulus">Lulus</option>
                                </select>
                            </form>
                        </div>
                        <div class="relative overflow-x-auto shadow md:rounded" style="height: 180px">
                            @if(!$mahasiswa)
                                <div class="pb-4 bg-white dark:bg-gray-900">
                                    <p class="mt-2 ml-2 text-base text-gray-500 dark:text-gray-400">Belum ada mahasiswa perwalian. Mohon hubungi Admin.</p>
                                </div>
                            @else
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sortable-table">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400 border border-gray-300 dark:border-gray-900">
                                        <tr>
                                            <th scope="col" class="text-center py-3 w-12">
                                                No
                                            </th>
                                            <th scope="col" class="px-4 py-3 w-20 text-center" onclick="sortTable(1)">
                                                ID
                                                <button class="sort-button ml-1">
                                                    <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                                </button>
                                            </th>
                                            <th scope="col" class="px-4 py-3 w-52" onclick="sortTable(2)">
                                                Nama
                                                <button class="sort-button ml-1">
                                                    <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                                </button>
                                            </th>
                                            <th scope="col" class="px-4 py-3 w-32 text-center" onclick="sortTable(3)">
                                                Status
                                                <button class="sort-button ml-1">
                                                    <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                                </button>
                                            </th>
                                            <th scope="col" class="text-center py-3 w-28">
                                                Presensi
                                            </th>
                                            <th scope="col" class="text-center py-3 w-28">
                                                Progress
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700 dark:text-gray-400 overflow-y-auto">
                                        @if ($mahasiswa)
                                            @foreach ($mahasiswa as $index => $mhs)
                                                <tr class="text-xs bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-900">
                                                    <td class="py-3.5 text-center w-12">
                                                        {{ $index + 1 }}
                                                    </td>
                                                    <td class="px-4 py-3.5 w-20 text-center">
                                                        {{ $mhs->id_mhs }}
                                                    </td>
                                                    <td class="flex items-center px-4 py-3.5">
                                                        <img class="w-7 h-7 rounded-full" src="{{ asset('storage/' . $mhs->foto) }}" alt="Jese image">
                                                        <div class="ps-3">
                                                            {{ $mhs->nama }}
                                                        </div>  
                                                    </td>
                                                    <td class="px-4 py-3.5 w-32 text-center">
                                                        @if ($mhs->status == 'Aktif')
                                                            <span type="botton" class="bg-green-100 text-green-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300" style="font-size: 10px">Aktif</span>
                                                        @else
                                                            @if ($mhs->status == 'Tidak Aktif')
                                                                <span type="submit" class="bg-pink-100 text-pink-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300" style="font-size: 10px">Tidak Aktif</span>
                                                            @else
                                                                <span type="submit" class="bg-blue-100 text-blue-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300" style="font-size: 10px">Lulus</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3.5 w-28 text-center">
                                                        {{ count($mhsAbsen->where('id_mhs', $mhs->id_mhs)) }}
                                                    </td>
                                                    <td class="px-4 py-3.5 w-28 text-center">
                                                        {{ count($mhsProgress->where('id_mhs', $mhs->id_mhs)) }}
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
                            @endif
                        </div>
                    </div>
                </div>
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
        </script>
    </body>
</html>
@endsection