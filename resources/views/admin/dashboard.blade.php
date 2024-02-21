@extends('index_admin')
@section('title', 'Dashboard')

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

    <body class="font-poppins">  
        <div class="p-4 sm:ml-64">
            <nav class="bg-zinc-100 border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg">
                {{-- Welcome User --}}
                <div class="flex p-2">
                    <p class="text-base font-semibold whitespace-nowrap text-black dark:text-white ml-2">Hello, {{ $admin->nama }} 👋</p>
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
        </div>

        <div class="px-4 sm:ml-64 mb-4">
            <div class="grid grid-cols-5 gap-3">
                {{-- Profile --}}
                <div class="col-span-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800 w-full h-full">
                    {{-- Header Card --}}
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-zinc-100 dark:border-gray-800 dark:text-gray-400 dark:bg-gray-900" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                        <li class="me-2">
                            <p class="font-bold text-black dark:text-white py-1.5 px-6 text-base">Profile</p>
                        </li>
                    </ul>

                    {{-- Foto --}}
                    <figcaption class="flex h-3/4 pt-4 items-center px-5">
                        <img class="rounded-full w-28 h-28" src="{{ Auth::user()->getImageURL() }}" alt="profile picture">
                        <div class="ml-4">
                            <div class="text-black dark:text-white text-sm font-bold">{{ $admin->nama }}</div>
                            <div class="text-xs text-gray-700 dark:text-gray-400 mt-1">NIP. {{ $admin->nip }}</div>
                            <div class="text-xs text-gray-700 dark:text-gray-400 mt-1 mb-1">Admin SINFORMA Diskominfo</div>
                            {{-- No.HP --}}
                            <div class="py-2.5 flex">
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                    <path fill-rule="evenodd" d="m3.855 7.286 1.067-.534a1 1 0 0 0 .542-1.046l-.44-2.858A1 1 0 0 0 4.036 2H3a1 1 0 0 0-1 1v2c0 .709.082 1.4.238 2.062a9.012 9.012 0 0 0 6.7 6.7A9.024 9.024 0 0 0 11 14h2a1 1 0 0 0 1-1v-1.036a1 1 0 0 0-.848-.988l-2.858-.44a1 1 0 0 0-1.046.542l-.534 1.067a7.52 7.52 0 0 1-4.86-4.859Z" clip-rule="evenodd" />
                                </svg></span>
                                <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $admin->no_telepon }}</span>
                            </div>
                            {{-- Email --}}
                            <div class="flex">
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                    <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                    <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                </svg></span>
                                <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $admin->email }}</span>
                            </div>
                        </div>
                    </figcaption>  
                </div>

                <div class="col-span-3">
                    {{-- Carousel --}}
                    <div class="items-center justify-center rounded-lg bg-zinc-100 dark:bg-gray-900">
                        @if (count($berita) == 0)
                            <div class="flex items-center justify-center w-full h-56 rounded-md">
                                <p class="italic font-semibold text-lg text-zinc-500">~ event belum tersedia ~</p>
                            </div>                       
                        @else
                            @if (count($berita) == 1)
                                <div class="relative w-full h-56">
                                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                        <img src="{{ asset('storage/' . $berita[0]->gambar) }}" class="absolute w-full h-56 -translate-x-1/2 -translate-y-1/2 top-28 left-1/2 object-cover rounded-lg" alt="{{ $berita[0]->nama }}">
                                    </div>
                                </div>
                            @else
                                <div id="default-carousel" class="relative w-full h-56" data-carousel="slide">
                                    <!-- Carousel wrapper -->
                                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                        @foreach ($berita as $item)
                                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                                <img src="{{ asset('storage/' . $item->gambar) }}" class="absolute w-full h-56 -translate-x-1/2 -translate-y-1/2 top-28 left-1/2 object-cover rounded-lg" alt="{{ $item->nama }}">
                                            </div>
                                        @endforeach
                                    </div>                            

                                    <!-- Left Button -->
                                    <button type="button" class="absolute top-28 start-0 z-30 flex items-center justify-center h-5 px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/30 dark:bg-gray-900/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                            <svg class="w-2 h-2 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                            </svg>
                                            <span class="sr-only">Previous</span>
                                        </span>
                                    </button>

                                    {{-- Right Button --}}
                                    <button type="button" class="absolute top-28 end-0 z-30 flex items-center justify-center h-5 px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/30 dark:bg-gray-900/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                            <svg class="w-2 h-2 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                            </svg>
                                            <span class="sr-only">Next</span>
                                        </span>
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 sm:ml-64 mb-4 grid grid-cols-4 gap-3">
            <div class="col-span-1">
                <div class="grid grid-rows-2 gap-3">
                    {{-- Total --}}
                    <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800 py-4">
                        <div class="w-1.5 ml-3 bg-yellow-100 dark:bg-yellow-200 rounded-full"></div>
                        <div class="w-full text-center mr-4">
                            <h1 class="text-xs font-bold text-black dark:text-white">Total</h1>
                            <h1 class="text-2xl font-bold text-yellow-300">{{ $totalMahasiswa }}</h1>
                            <p class="text-gray-500 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                        </div>
                    </div>
                    
                    {{-- Aktif --}}
                    <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800 py-4">
                        <div class="w-1.5 ml-3 bg-green-200 dark:bg-green-500 rounded-full"></div>
                        <div class="w-full text-center mr-4">
                            <h1 class="text-xs font-bold text-black dark:text-white">Status: Aktif</h1>
                            <h1 class="text-2xl font-bold text-green-700 dark:text-green-500">{{ $totalAktif }}</h1>
                            <p class="text-gray-500 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="grid grid-rows-2 gap-3">
                    {{-- Tidak Aktif --}}
                    <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800 py-4">
                        <div class="w-1.5 ml-3 bg-red-200 dark:bg-pink-500 rounded-full"></div>
                        <div class="w-full text-center mr-4">
                            <h1 class="text-xs font-bold text-black dark:text-white">Status: Tidak Aktif</h1>
                            <h1 class="text-2xl font-bold text-pink-700 dark:text-pink-500">{{ $totalNonAktif }}</h1>
                            <p class="text-gray-500 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                        </div>
                    </div>
                    
                    {{-- Lulus --}}
                    <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800 py-4">
                        <div class="w-1.5 ml-3 bg-blue-200 dark:bg-blue-500 rounded-full"></div>
                        <div class="w-full text-center mr-4">
                            <h1 class="text-xs font-bold text-black dark:text-white">Status: Lulus</h1>
                            <h1 class="text-2xl font-bold text-blue-700 dark:text-blue-500">{{ $totalLulus }}</h1>
                            <p class="text-gray-500 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="grid grid-rows-2 gap-3">
                    {{-- SKL: Sudah Terbit --}}
                    <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800 py-4">
                        <div class="w-1.5 ml-3 bg-purple-200 dark:bg-purple-500 rounded-full"></div>
                        <div class="w-full text-center mr-4">
                            <h1 class="text-xs font-bold text-black dark:text-white">SKL: Sudah Terbit</h1>
                            <h1 class="text-2xl font-bold text-purple-700 dark:text-purple-500">{{ count($skl1) }}</h1>
                            <p class="text-gray-500 dark:text-gray-500" style="font-size: 10px">SKL sudah diterbitkan</p>
                        </div>
                    </div>
                    
                    {{-- SKL: Belum Terbit --}}
                    <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800 py-4">
                        <div class="w-1.5 ml-3 bg-fuchsia-200 dark:bg-fuchsia-500 rounded-full"></div>
                        <div class="w-full text-center mr-4">
                            <h1 class="text-xs font-bold text-black dark:text-white">SKL: Belum Terbit</h1>
                            <h1 class="text-2xl font-bold text-fuchsia-500">{{ count($skl2) }}</h1>
                            <p class="text-gray-500 dark:text-gray-500" style="font-size: 10px">SKL belum diterbitkan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                {{-- Rekap Presensi --}}
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800">
                    <div class="flex flex-col text-center py-6">
                        <div class="text-xs font-bold text-black dark:text-white">Verifikasi Presensi</div>
                        <div class=" text-gray-500 dark:text-gray-500" style="font-size: 10px">Berapa presensi yang belum diverifikasi?</div>
                        <div class="my-3.5 self-center">
                            <img class="h-16 w-16 self-center" src="{{ asset('assets/skl_belum.png') }}" alt="image description">
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="text-xs font-medium text-gray-700 dark:text-gray-400 text-center border-r border-gray-700 dark:border-gray-500">
                                Belum <br> Diverifikasi
                            </div>
                            <div class="text-2xl font-bold dark:text-white">
                                {{ count($mahasiswaVerifikasiPresensi) }}
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 sm:ml-64 mb-4">
            {{-- Daftar Mahasiswa --}}
            <div class="mt-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-800 p-5" style="height: 300px">
                <div class="flex mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-6 h-6 fill-gray-800 dark:fill-white">
                        <path d="M8 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5ZM3.156 11.763c.16-.629.44-1.21.813-1.72a2.5 2.5 0 0 0-2.725 1.377c-.136.287.102.58.418.58h1.449c.01-.077.025-.156.045-.237ZM12.847 11.763c.02.08.036.16.046.237h1.446c.316 0 .554-.293.417-.579a2.5 2.5 0 0 0-2.722-1.378c.374.51.653 1.09.813 1.72ZM14 7.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM3.5 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM5 13c-.552 0-1.013-.455-.876-.99a4.002 4.002 0 0 1 7.753 0c.136.535-.324.99-.877.99H5Z" />
                    </svg>
                    <h1 class="font-bold text-gray-800 dark:text-white ml-2">Daftar Mahasiswa Magang</h1>
                    <div class="flex ml-auto">
                        {{-- Search --}}
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-500">
                                    <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                                </svg>                          
                            </div>
                            <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Mahasiswa Magang">
                        </div>
            
                        {{-- Filter by Status --}}
                        <form action="{{ route('dashboard_admin_filter') }}" method="GET" class="flex ml-2 mb-1 items-center">
                            <select id="status" name="status" class="p-1 text-xs text-gray-900 border ps-2.5 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="this.form.submit()">
                                <option value="" selected>Status</option>
                                <option value="">Semua Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                                <option value="Lulus">Lulus</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow" style="height: 217px">
                    @if(!$mahasiswa)
                        <div class="pb-4 bg-white dark:bg-gray-900">
                            <p class="mt-2 ml-2 text-base text-gray-500 dark:text-gray-400">Belum ada mahasiswa perwalian. Mohon hubungi Admin.</p>
                        </div>
                    @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sortable-table">
                            <thead class="text-xs text-gray-700 uppercase bg-zinc-100 dark:bg-gray-900 dark:text-gray-400 border border-gray-300 dark:border-black">
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
                                    <th scope="col" class="px-4 py-3 w-32 text-center">
                                        Total Absen
                                    </th>
                                    <th scope="col" class="px-4 py-3 w-32 text-center">
                                        Total Progress
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-400 overflow-y-auto">
                                @if ($mahasiswa)
                                    @foreach ($mahasiswa as $index => $mhs)
                                        <tr class="text-xs bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-300 dark:border-black">
                                            <td class="py-3.5 text-center w-12">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="px-4 py-3.5 w-20 text-center">
                                                {{ $mhs->id_mhs }}
                                            </td>
                                            <td class="flex items-center px-4 py-3.5">
                                                @if (!empty($mhs->foto))
                                                    <img class="w-7 h-7 rounded-full" src="{{ asset('storage/' . $mhs->foto) }}" alt="...">
                                                @else
                                                    <img class="w-7 h-7 rounded-full" src="{{ asset('assets/profpic_naruto.jpg') }}" alt="...">
                                                @endif

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
                                            <td class="px-4 py-3.5 w-32 text-center">
                                                {{ count($mhsAbsen->where('id_mhs', $mhs->id_mhs)) }}
                                            </td>
                                            <td class="px-4 py-3.5 w-32 text-center">
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