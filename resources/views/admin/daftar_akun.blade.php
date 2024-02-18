@extends('index_admin')
@section('title', 'Daftar Akun')

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

<body class="h-screen">
    <div class="p-4 sm:ml-64">
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

        <div class="relative rounded-lg w-full bg-white dark:bg-gray-700 h-28 mb-4">
            <img src="{{ asset('assets/header_4.png') }}" class="w-full absolute h-28 object-cover rounded-lg" alt="...">
            <div class="absolute top-0 right-0 mt-3 mr-2">
                {{-- Icon --}}
                <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <!-- Dropdown menu -->
                    <span><button type="button" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 px-2" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-start">
                        <span class="sr-only">Open user menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5 fill-white">
                            <path fill-rule="evenodd" d="M6.955 1.45A.5.5 0 0 1 7.452 1h1.096a.5.5 0 0 1 .497.45l.17 1.699c.484.12.94.312 1.356.562l1.321-1.081a.5.5 0 0 1 .67.033l.774.775a.5.5 0 0 1 .034.67l-1.08 1.32c.25.417.44.873.561 1.357l1.699.17a.5.5 0 0 1 .45.497v1.096a.5.5 0 0 1-.45.497l-1.699.17c-.12.484-.312.94-.562 1.356l1.082 1.322a.5.5 0 0 1-.034.67l-.774.774a.5.5 0 0 1-.67.033l-1.322-1.08c-.416.25-.872.44-1.356.561l-.17 1.699a.5.5 0 0 1-.497.45H7.452a.5.5 0 0 1-.497-.45l-.17-1.699a4.973 4.973 0 0 1-1.356-.562L4.108 13.37a.5.5 0 0 1-.67-.033l-.774-.775a.5.5 0 0 1-.034-.67l1.08-1.32a4.971 4.971 0 0 1-.561-1.357l-1.699-.17A.5.5 0 0 1 1 8.548V7.452a.5.5 0 0 1 .45-.497l1.699-.17c.12-.484.312-.94.562-1.356L2.629 4.107a.5.5 0 0 1 .034-.67l.774-.774a.5.5 0 0 1 .67-.033L5.43 3.71a4.97 4.97 0 0 1 1.356-.561l.17-1.699ZM6 8c0 .538.212 1.026.558 1.385l.057.057a2 2 0 0 0 2.828-2.828l-.058-.056A2 2 0 0 0 6 8Z" clip-rule="evenodd" />
                        </svg>  
                    </button></span>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown" style="width: 160px;">
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
        </div>

        {{-- Header --}}
        <div class="mb-5 text-center">
            <h1 class="basis-3/4 text-black dark:text-white font-bold text-xl">Rekapitulasi Daftar Akun Mahasiswa Magang</h1>
            <p class="text-gray-500 dark:text-gray-400 font-normal text-xs mb-2">Unduh dan bagikan username serta password ke mahasiswa magang!</p>
        </div>

        <div class="p-4 bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow mt-4 h-1/2">
            <div class="flex items-center mb-3">
                {{-- Search --}}  
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-500">
                            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                        </svg>                          
                    </div>
                    <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Realtime Progress">
                </div>

                {{-- Download --}}
                <a href="{{ route('cetak_akun_mhs') }}" class="ml-auto">             
                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-md w-32 h-8 text-center dark:bg-red-600 dark:hover:bg-red-700 flex items-center px-3" style="font-size: 11px">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mr-1">
                            <path fill-rule="evenodd" d="M4.5 13a3.5 3.5 0 0 1-1.41-6.705A3.5 3.5 0 0 1 9.72 4.124a2.5 2.5 0 0 1 3.197 3.018A3.001 3.001 0 0 1 12 13H4.5Zm6.28-3.97a.75.75 0 1 0-1.06-1.06l-.97.97V6.25a.75.75 0 0 0-1.5 0v2.69l-.97-.97a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.06 0l2.25-2.25Z" clip-rule="evenodd" />
                        </svg>    
                        Download PDF
                    </button>
                </a>
            </div>

            {{-- Tabel --}}
            <div class="relative shadow md:rounded">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sortable-table overflow-y-auto">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400 border border-gray-300 dark:border-gray-900">
                        <tr>
                            <th scope="col" class="px-4 py-4 w-12 text-center">
                                No
                            </th>
                            <th scope="col" class="px-4 py-4 w-28 text-center" onclick="sortTable(1)">
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
                                Username
                            </th>
                            <th scope="col" class="px-4 py-4 w-40" onclick="sortTable(4)">
                                Password
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-gray-400 overflow-y-auto">
                        @if ($accounts)
                            @foreach ($accounts as $index => $account)
                                <tr class="text-xs bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-900">
                                    <td class="px-4 py-4 text-center w-12">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-4 w-20 text-center">
                                        {{ $account->id_mhs }}
                                    </td>
                                    <td class="flex items-center px-4 py-4 w-52">
                                        {{ $account->nama }}
                                    </td>
                                    <td class="px-4 py-4 w-40">
                                        {{ $account->username }}
                                    </td>
                                    <td class="px-4 py-4 w-40">
                                        {{ $account->password }}
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
            <p class="mt-2 text-gray-500 dark:text-gray-400" style="font-size: 9px">* Hanya menampilkan daftar akun mahasiswa yang belum melakukan login ke sistem</p>
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