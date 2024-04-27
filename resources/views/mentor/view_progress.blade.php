@extends('index_mentor')
@section('title', 'Progress Mahasiswa')

@section('isihalaman')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

<body>
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

        @if (session('info'))
            <div id="notification-info" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-900 dark:text-blue-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('info') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-900 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

            <script>
                // Hide info notification after 5000 milliseconds (5 seconds)
                setTimeout(function() {
                    document.getElementById('notification-info').style.display = 'none';
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div id="notification-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
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
                <div class="ml-1 flex items-center">
                    <p class="self-center text-sm font-semibold whitespace-nowrap text-black dark:text-white ml-1">Rekapitulasi Progress Mahasiswa Magang</p>
                </div>
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

        <div class="grid grid-cols-5 gap-3">
            {{-- Profile --}}
            <div class="bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow mt-4 col-span-2">
                {{-- Foto --}}
                <figcaption class="flex items-center py-5 px-5">
                    <img src="{{ $foto }}" alt="..." class="w-24 h-24 object-cover rounded-full ml-1"/>
                    <div class="mx-4">
                        <div class="text-black dark:text-white text-sm font-bold">{{ $mahasiswa->nama }}</div>
                        <div class="text-xs text-gray-700 dark:text-gray-400 mt-1">ID. {{ $mahasiswa->id_mhs }} | {{ $mahasiswa->status }}</div>
                        {{-- Jurusan --}}
                        <div class="py-2 flex items-center">
                            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                <path fill-rule="evenodd" d="M11 4V3a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v1H4a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1ZM9 2.5H7a.5.5 0 0 0-.5.5v1h3V3a.5.5 0 0 0-.5-.5ZM9 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" clip-rule="evenodd" />
                                <path d="M3 11.83V12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-.17c-.313.11-.65.17-1 .17H4c-.35 0-.687-.06-1-.17Z" />
                            </svg></span>
                            <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $mahasiswa->jurusan }}</span>
                        </div>
                        {{-- Instansi --}}
                        <div class="flex items-center">
                            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                <path fill-rule="evenodd" d="M7.605 2.112a.75.75 0 0 1 .79 0l5.25 3.25A.75.75 0 0 1 13 6.707V12.5h.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H3V6.707a.75.75 0 0 1-.645-1.345l5.25-3.25ZM4.5 8.75a.75.75 0 0 1 1.5 0v3a.75.75 0 0 1-1.5 0v-3ZM8 8a.75.75 0 0 0-.75.75v3a.75.75 0 0 0 1.5 0v-3A.75.75 0 0 0 8 8Zm2 .75a.75.75 0 0 1 1.5 0v3a.75.75 0 0 1-1.5 0v-3ZM8 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                            </svg></span>
                            <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $mahasiswa->instansi }}</span>
                        </div>
                    </div>
                </figcaption> 
            </div>

            {{-- Progress dengan status Verified --}}
            <div class="flex flex-col items-center bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow mt-4 col-span-1 text-center p-4">
                <div class="text-xs font-medium text-gray-700 dark:text-gray-400">Total Pengumpulan Progress</div>
                <div class="my-2 font-bold text-2xl text-gray-700 dark:text-white">{{ $progVer->count() }}</div>
                <span class="pointer-events-none bg-blue-100 text-blue-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300" style="font-size: 9px">Status: Verified</span>
            </div>

            {{-- Progress dengan status Unverified --}}
            <div class="flex flex-col items-center bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow mt-4 col-span-1 text-center p-4">
                <div class="text-xs font-medium text-gray-700 dark:text-gray-400">Total Pengumpulan Progress</div>
                <div class="my-2 font-bold text-2xl text-gray-700 dark:text-white">{{ $progUnver->count() }}</div>
                <span class="pointer-events-none bg-pink-100 text-pink-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300" style="font-size: 9px">Status: Unverified</span>
            </div>

            {{-- Persentase Pengumpulan Progress --}}
            @php
                use Jenssegers\Date\Date;
                Date::setLocale('id');

                $mulaiMagang = \Carbon\Carbon::parse($mahasiswa->mulai_magang);
                $selesaiMagang = \Carbon\Carbon::parse($mahasiswa->selesai_magang);

                // Progress
                $jumlahHariProgress = $mulaiMagang->diffInDaysFiltered(function($date) {
                    return $date; 
                }, $selesaiMagang->addDay());

                $jumlahMinggu = ceil($jumlahHariProgress / 7); // ceil => pembulatan ke atas
            @endphp

            <div class="flex flex-col items-center bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow mt-4 col-span-1 text-center p-4">
                <div class="text-xs font-medium text-gray-700 dark:text-gray-400">Akumulasi Persentase Progress</div>
                <div class="my-2 font-bold text-2xl text-gray-700 dark:text-white">{{ number_format(($progVer->count()/$jumlahMinggu)*100, 2)}}%</div>
                <span class="pointer-events-none bg-green-100 text-green-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300" style="font-size: 9px">Status: Verified</span>
            </div>
        </div>

        {{-- BG Table --}}
        <div class="p-4 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow mt-4">
            <div class="flex items-center mb-3">
                {{--Kembali  --}}
                <a href="{{ route('daftar_mhs_mentor') }}" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-md w-20 h-8 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700" style="font-size: 11px">
                    <button type="button" class="w-full h-full">
                        Kembali
                    </button>
                </a> 

                {{-- Search --}}  
                <div class="relative ml-auto">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-500">
                            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                        </svg>                          
                    </div>
                    <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pencarian Realtime">
                </div>

                {{-- Filter by Status --}}
                <form action="{{ route('filterStatusProgress2', ['id_mhs' => $id_mhs]) }}" method="GET" class="flex ml-2 items-center">
                    <select id="status" name="status" class="w-full p-2 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="this.form.submit()">
                        <option value="" selected>Status</option>
                        <option value="">Semua Status</option>
                        <option value="Verified">Verified</option>
                        <option value="Unverified">Unverified</option>
                    </select>
                </form>
            </div>

            <div class="relative overflow-x-auto shadow">
                @if(!$progressMagang)
                    <div class="pb-4 bg-white dark:bg-gray-900">
                        <p class="mt-2 ml-2 text-base text-gray-500 dark:text-gray-400">Belum pernah mengisikan presensi.</p>
                    </div>
                @else
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sortable-table">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400 border border-gray-300 dark:border-black">
                            <tr>
                                <th scope="col" class="px-4 py-4 w-12 text-center">
                                    No
                                </th>
                                <th scope="col" class="px-4 py-4 w-48 text-center" onclick="sortTable(1)">
                                    Tanggal
                                    <button class="sort-button ml-1">
                                        <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-4 w-56 text-center" onclick="sortTable(2)">
                                    Deskripsi
                                    <button class="sort-button ml-1">
                                        <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-4 w-40 text-center">
                                    File Progress
                                </th>
                                <th scope="col" class="px-4 py-4 w-32 text-center">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-400 overflow-y-auto">
                            @if ($progressMagang)
                                @foreach ($progressMagang as $index => $progress)
                                    <tr class="text-xs bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-300 dark:border-black">
                                        <td class="px-4 py-4 text-center w-12">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-4 py-4 w-48 text-center">
                                            {{ $progress->tanggal }}
                                        </td>
                                        <td class="px-4 py-4 w-56 text-justify">
                                            {{ $progress->deskripsi }}
                                        </td>
                                        <td class="px-4 py-4 w-40 text-center">
                                            <a href="{{ asset('storage/' . $progress->scan_file) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium hover:font-bold me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 hover:dark:bg-blue-950 dark:text-blue-300" style="font-size: 10px">Lihat File</a>
                                        </td>
                                        <td class="px-4 py-4 w-32 text-center">
                                            @if ($progress->status == 'Verified')
                                                <span class="pointer-events-none bg-green-100 text-green-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300" style="font-size: 10px">Verified</span>
                                            @else
                                                <span class="pointer-events-none bg-pink-100 text-pink-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300" style="font-size: 10px">Unverified</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400 z-30">No data available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                @endif
            </div>  
            <p class="mt-2 text-gray-500 dark:text-gray-400" style="font-size: 9px">* Total progress (status: verified + status: unverified) = {{ $progVer->count() + $progUnver->count() }}</p>   
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
@endsection
