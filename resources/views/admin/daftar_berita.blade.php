@extends('index_admin')
@section('title', 'Daftar Event')

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
            <h1 class="basis-3/4 text-black dark:text-white font-bold text-xl">Berita Acara Mahasiswa Magang</h1>
            <p class="text-gray-500 dark:text-gray-400 font-normal text-xs mb-2">Anda dapat menambahkan event magang yang dapat dilihat seluruh mahasiswa!</p>
        </div>

        <div class="p-4 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow mt-4 h-1/2">
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

                {{-- Tambah Event --}}
                <div class="ml-auto">             
                    <button data-modal-target="add-event" data-modal-toggle="add-event" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-md w-32 h-8 text-center dark:bg-blue-600 dark:hover:bg-blue-700 flex items-center px-3" style="font-size: 11px">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 mr-1">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z" clip-rule="evenodd" />
                          </svg>                             
                        Tambah Event
                    </button>
                </div>

                {{-- Pop Up Tambah Event  --}}
                <form action="{{ route('tambah_berita') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div id="add-event" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ml-24">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                                        Tambah Event Baru
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-event">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form class="p-4 md:p-5" id="add-event-form">
                                    <div class="space-y-4 p-4">
                                        <div>
                                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                            <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan nama event" required="">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Upload Event</label>                                        
                                            <div class="flex items-center justify-center w-full mt-2">
                                                <label id="border" for="gambar" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                    <div class="flex flex-col items-center justify-center pt-3 pb-3">
                                                        <svg id="icon" class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                        </svg>
                                                        <p id="header" class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                        <p id="file-name" class="text-gray-500 dark:text-gray-400" style="font-size: 11px">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                                    </div>
                                                    <input id="gambar" name="gambar" type="file" class="input mb-2 hidden" onchange="displayFileName(this)"/>
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="flex space-x-2">
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700">Upload</button>
                                            <button onclick="resetUpload()" type="reset" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700">Reset</button>
                                        </div>                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>

            {{-- Tabel --}}
            <div class="relative shadow md:rounded">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sortable-table overflow-y-auto">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400 border border-gray-300 dark:border-black">
                        <tr>
                            <th scope="col" class="px-4 py-4 w-12 text-center">
                                No
                            </th>
                            <th scope="col" class="px-4 py-4 w-40" onclick="sortTable(1)">
                                Nama
                                <button class="sort-button ml-1">
                                    <span class="bg-gray-100 dark:bg-gray-900">&#8693;</span>
                                </button>
                            </th>
                            <th scope="col" class="px-4 py-4 w-28 text-center">
                                Event
                            </th>
                            <th scope="col" class="px-4 py-4 w-28 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-gray-400 overflow-y-auto">
                        @if ($berita)
                            @foreach ($berita as $index => $event)
                                <tr class="text-xs bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-300 dark:border-black">
                                    <td class="px-4 py-4 text-center w-12">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-4 w-40 ">
                                        {{ $event->nama }}
                                    </td>
                                    <td class="px-4 py-4 w-28 text-center">
                                        <a href="{{ asset('storage/' . $event->gambar) }}" class="bg-blue-100 text-blue-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300" style="font-size: 10px">Lihat Gambar</a>
                                    </td>
                                    <td class="px-4 py-4 w-28">
                                        {{-- Edit --}}
                                        <div class="flex justify-center">
                                            <button data-modal-target="update-event-{{ $event->id_berita }}" data-modal-toggle="update-event-{{ $event->id_berita }}" type="submit" data-tooltip-target="tooltip-edit-hover-{{ $loop->index }}" data-tooltip-trigger="hover">
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
                                            <button class="ml-0.5" data-modal-target="delete-modal-{{ $event->id_berita }}" data-modal-toggle="delete-modal-{{ $event->id_berita }}" data-tooltip-target="tooltip-delete-hover-{{ $loop->index }}" data-tooltip-trigger="hover">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5">
                                                    <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                                </svg>
                                            </button>   
                                            <div id="tooltip-delete-hover-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700" style="font-size: 10px">
                                                Delete
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                        </div> 

                                        {{-- Update Tambah Event  --}}
                                        <form action="{{ route('update_berita', [$event->id_berita]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf 
                                            <div id="update-event-{{ $event->id_berita }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ml-24">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                                                                Update Berita Acara
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="update-event-{{ $event->id_berita }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form class="p-4 md:p-5" id="update-event-{{ $event->id_berita }}-form">
                                                            <div class="space-y-4 p-4">
                                                                <div>
                                                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                                                    <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan nama event" value="{{ old('nama', $event->nama) }}">
                                                                    @error('nama')
                                                                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-900 dark:text-red-400"
                                                                            role="alert">
                                                                            <div>
                                                                                {{ $message }}
                                                                            </div>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div>
                                                                    <label class="block text-sm font-medium text-gray-900 dark:text-white">Upload Event<label>                                        
                                                                    <div class="flex items-center justify-center w-full mt-2">
                                                                        <label id="border-{{ $event->id_berita }}" for="gambar-{{ $event->id_berita }}" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                                            <div class="flex flex-col items-center justify-center pt-3 pb-3">
                                                                                <svg id="icon-{{ $event->id_berita }}" class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                                                </svg>
                                                                                <p id="header-{{ $event->id_berita }}" class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                                                <p id="file-name-{{ $event->id_berita }}" class="text-gray-500 dark:text-gray-400" style="font-size: 11px">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                                                            </div>
                                                                            <input id="gambar-{{ $event->id_berita }}" name="gambar" type="file" class="input mb-2 hidden" onchange="displayFileName2('{{ $event->id_berita }}')"/>
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                                <div class="flex space-x-2">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700">Update</button>
                                                                    <button onclick="resetUpload2('{{ $event->id_berita }}')" type="reset" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700">Reset</button>
                                                                </div>                                                                
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> 
                                        </form>

                                        {{-- Pop Up Delete --}}
                                        <div id="delete-modal-{{ $event->id_berita }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ml-32">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $event->id_berita }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin menghapus berita acara ini?</h3>
                                                        <div class="flex justify-center">
                                                            <form method="POST" action="{{ route('delete_berita', [$event->id_berita]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button data-modal-hide="delete-modal-{{ $event->id_berita }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-xs inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                    Ya
                                                                </button>
                                                            </form>
                                                            <button data-modal-hide="delete-modal-{{ $event->id_berita }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-xs font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            <p class="mt-2 text-gray-500 dark:text-gray-400" style="font-size: 9px">* Semua yang ada dalam tabel berita acara akan ditampilkan dalam display!</p>
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
            // Temukan formulir dengan ID 'add-event-form'
            var form = document.getElementById('add-event-form');

            // Temukan elemen input file
            var inputFile = document.getElementById('gambar');
        });

        function displayFileName(input) {
            var fileNameDisplay = document.getElementById('file-name');
            var headerDisplay = document.getElementById('header');
            var iconDisplay = document.getElementById('icon');
            var borderDisplay = document.getElementById('border');

            if (input.files.length > 0) {
                var fileName = `Nama file: <span style="font-weight: bold; color: green;">${input.files[0].name}</span>`;
                fileNameDisplay.innerHTML = fileName;
                headerDisplay.innerHTML = '<span class="font-semibold" style="color: green">Berhasil</span> mengupload file!';
                iconDisplay.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 50 50" fill="green"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" /></svg>';
                borderDisplay.style.borderColor = 'green';
                borderDisplay.style.backgroundColor = '#dcfce7';
            } else {
                fileNameDisplay.textContent = 'SVG, PNG, JPG or GIF (MAX. 800x400px)';
            }
        }

        function resetUpload() {
            document.getElementById('file-name').innerText = 'SVG, PNG, JPG or GIF (MAX. 800x400px)';
            document.getElementById('header').innerHTML = '<span class="font-semibold">Click to upload</span> or drag and drop';
            document.getElementById('icon').innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>';
            document.getElementById('border').style.borderColor = '#d4d4d8';
            document.getElementById('border').style.backgroundColor = '#f4f4f5';
        }

        function displayFileName2(id) {
            const fileInput = document.getElementById(`gambar-${id}`);
            const fileNameDisplay = document.getElementById(`file-name-${id}`);
            const fileNameHeader = document.getElementById(`header-${id}`);
            var svgElement = document.getElementById(`icon-${id}`);
            var labelElement = document.getElementById(`border-${id}`);

            if (fileInput.files.length > 0) {
                fileNameDisplay.innerHTML = `Nama file: <span style="font-weight: bold; color: green;">${fileInput.files[0].name}</span>`;
                fileNameHeader.innerHTML = '<span class="font-semibold" style="color: green">Berhasil</span> mengupload file!';
                svgElement.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 50 50" fill="green"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" /></svg>';

                labelElement.style.borderColor = 'green';
                labelElement.style.backgroundColor = '#dcfce7';
            } else {
                fileNameDisplay.textContent = 'SVG, PNG, JPG or GIF (MAX. 800x400px)';
            }
        }

        function resetUpload2(id) {
            const fileInput = document.getElementById(`gambar-${id}`);
            const fileNameDisplay = document.getElementById(`file-name-${id}`);
            const fileNameHeader = document.getElementById(`header-${id}`);
            var svgElement = document.getElementById(`icon-${id}`);
            var labelElement = document.getElementById(`border-${id}`);
            labelElement.style.borderColor = '#d4d4d8';
            labelElement.style.backgroundColor = '#f4f4f5';

            fileInput.value = ''; // Clear file input
            fileNameDisplay.textContent = 'SVG, PNG, JPG or GIF (MAX. 800x400px)';
            fileNameHeader.innerHTML = '<span class="font-semibold">Click to upload</span> or drag and drop';
            svgElement.innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>';
        }
    </script>
</body>
@endsection