@extends('index_mentor')
@section('title', 'Rekap Mahasiswa')

@section('isihalaman')
<!DOCTYPE html>
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
            <div id="notification" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="notification" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
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
        @endif

        <nav class="bg-zinc-100 border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg">
            {{-- Welcome User --}}
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2.5">
                <div class="ml-1 flex items-center">
                    <a href="{{ route('rekap_progress') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 dark:fill-white">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z" clip-rule="evenodd" />
                        </svg>
                    </a> 
                    <p class="self-center text-sm font-semibold whitespace-nowrap text-black dark:text-white ml-2">Rekapitulasi Progress Mahasiswa Magang</p>
                </div>
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

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-md dark:border-gray-600 mt-2">
        {{-- Header --}}
        <div class="grid justify-center mb-6 text-center">
            <div class="mb-1 text-base font-semibold text-black dark:text-white">{{ $generate_progress->judul }}</div>
            <div class="flex text-gray-600 dark:text-gray-400">
                <div class="text-xs font-normal">Open
                    <span class="bg-green-100 text-green-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300" style="font-size: 10px">
                        {{ \Carbon\Carbon::parse($generate_progress->mulai_submit)->format('Y-m-d H:i') }}
                    </span>
                </div>
                <div class="text-xs font-normal">Due to
                    <span class="bg-pink-100 text-pink-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300" style="font-size: 10px">
                        {{ \Carbon\Carbon::parse($generate_progress->selesai_submit)->format('Y-m-d H:i') }}
                    </span>
                </div>
                @php
                    $now = \Carbon\Carbon::now('Asia/Jakarta');
                    $mulaiSubmit = \Carbon\Carbon::parse($generate_progress->mulai_submit);
                    $selesaiSubmit = \Carbon\Carbon::parse($generate_progress->selesai_submit);

                    $isInTimeRange = $now >= $mulaiSubmit && $now <= $selesaiSubmit;
                @endphp
                <div class="text-xs font-normal">| Status
                    @if ($isInTimeRange)
                        <span class="ml-1 bg-yellow-100 text-yellow-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300" style="font-size: 10px">Aktif</span>
                    @else
                        <span class="ml-1 bg-gray-200 text-gray-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-800 dark:text-gray-300" style="font-size: 10px">Tidak Aktif</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Search --}}
        <div class="flex items-center mb-2">   
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-500">
                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                    </svg>                          
                </div>
                <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Realtime Progress" style="width: 690px">
            </div>

            {{-- Filter by Status --}}
            <form action="{{ route('filter_progress', ['id_progress' => $id_progress]) }}" method="GET" class="flex ml-2 items-center">
                <select id="status" name="status" class="w-full p-2 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="this.form.submit()">
                    <option value="" selected>Status</option>
                    <option value="">Semua Status</option>
                    <option value="Verified">Verified</option>
                    <option value="Unverified">Unverified</option>
                </select>
            </form>

            {{-- Count Rows --}}
            <div class="flex ml-auto font-poppins items-center mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3 h-3 fill-gray-600 dark:fill-gray-400">
                    <path d="M14 2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2.172a2 2 0 0 0 .586 1.414l2.828 2.828A2 2 0 0 1 6 9.828v4.363a.5.5 0 0 0 .724.447l2.17-1.085A2 2 0 0 0 10 11.763V9.829a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 0 14 4.172V2Z" />
                </svg>                  
                <h1 class="ml-1 text-gray-600 dark:text-gray-400 text-xs font-medium">Total : {{ $rekapMhs->count() }} Rows </h1>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow sm:rounded">
            @if(!$rekapMhs)
                <div class="pb-4 bg-white dark:bg-gray-900">
                    <p class="mt-2 ml-2 text-base text-gray-500 dark:text-gray-400">Tidak ada data verifikasi progress yang perlu diverifikasi.</p>
                </div>
            @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sortable-table">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-4 w-12">
                            No
                        </th>
                        <th scope="col" class="px-4 py-4 w-16" onclick="sortTable(1)">
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
                        <th scope="col" class="px-4 py-4 w-36 items-center" onclick="sortTable(5)">
                            Submit
                            <button class="sort-button ml-1">
                                <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                            </button>
                        </th>
                        <th scope="col" class="px-4 py-4 w-28 text-center">
                            File
                        </th>
                        <th scope="col" class="px-4 py-4 w-24 text-center">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($rekapMhs)
                    @foreach ($rekapMhs as $index => $rekap)
                            <tr class="text-xs bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-4 text-center w-12">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-4 py-4 w-16">
                                    {{ $rekap->id_mhs }}
                                </td>
                                <td class="flex items-center px-4 py-4 w-52">
                                    <img class="w-7 h-7 rounded-full" src="{{ asset('storage/' . $rekap->foto) }}" alt="Jese image">
                                    <div class="ps-3">
                                        {{ $rekap->nama }}
                                    </div>  
                                </td>
                                <td class="px-4 py-4 w-40">
                                    {{ $rekap->jurusan }}
                                </td>
                                <td class="px-4 py-4 w-40">
                                    {{ $rekap->instansi }}
                                </td>
                                <td class="px-4 py-4 w-36">
                                    {{ $rekap->tanggal }}
                                </td>
                                <td class="px-4 py-4 w-28 text-center">
                                    <a href="{{ asset('storage/' . $rekap->file) }}" class="bg-blue-100 text-blue-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300" style="font-size: 10px">Lihat File</a>
                                </td>
                                <td class="px-4 py-4 w-24 text-center">
                                    <form action="{{ route('verif_progress', ['id_progress' => $rekap->id_progress, 'id_mhs' => $rekap->mahasiswa->id_mhs]) }}" method="GET">
                                        @csrf
                                        @if ($rekap->status !== 'Verified')
                                            <button type="submit" class="bg-pink-100 text-pink-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300" style="font-size: 10px">Unverified</button>
                                        @else
                                            <button type="botton" class="bg-green-100 text-green-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300" style="font-size: 10px" disabled>Verified</button>
                                        @endif
                                    </form>
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