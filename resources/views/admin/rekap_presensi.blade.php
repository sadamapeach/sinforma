@extends('index_admin')
@section('title', 'Rekap Presensi')

@section('isihalaman')
<!DOCTYPE html>
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        /* Contoh CSS untuk Class "d-none" */
        .d-none {
            display: none;
        }
    </style>
</head>

<body>
    <div class="p-4 sm:ml-64">
        @if (session('success'))
            <div id="notification-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
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

            <script>
                // Hide success notification after 5000 milliseconds (5 seconds)
                setTimeout(function() {
                    document.getElementById('notification-success').style.display = 'none';
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
        <div class="mb-5">
            <div class="flex">
                <h1 class="basis-3/4 text-black dark:text-white font-bold text-xl">Rekapitulasi Presensi Mahasiswa Magang</h1>
                {{-- Search --}}
                <div class="flex items-center">   
                    <div class="relative" style="width: 250%">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-500">
                                <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                            </svg>                          
                        </div>
                        <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Realtime Presensi">
                    </div>
                </div>
            </div>
            <p class="text-gray-500 dark:text-gray-400 font-normal text-xs -mt-1 mb-2">Anda dapat mengamati presensi mahasiswa magang, mengedit, ataupun menghapusnya.</p>
        </div>

        {{-- Card --}}
        @foreach ($generate_absen as $absen)
            @php
                $now = \Carbon\Carbon::now('Asia/Jakarta');
                $mulaiAbsen = \Carbon\Carbon::parse($absen->mulai_absen);
                $selesaiAbsen = \Carbon\Carbon::parse($absen->selesai_absen);

                // Cek apakah waktu sudah berada dalam rentang open
                $isInTimeRange = $now >= $mulaiAbsen && $now <= $selesaiAbsen;
            @endphp

            <div class="p-5 mb-3 bg-white border border-gray-200 shadow rounded-lg dark:bg-gray-800 dark:border-gray-700 card">
                <div class="grid grid-cols-3">
                    <h1 class="col-span-2 font-semibold text-gray-900 dark:text-white mb-1.5" style="font-size: 15px">{{ $absen->judul }}</h1>
                    <div class="flex items-center justify-self-end col-span-1">
                        {{-- Edit --}}
                        <a href="{{ route('edit_absen', ['id_absen' => $absen->id_absen]) }}" data-tooltip-target="tooltip-edit-hover-{{ $loop->index }}" data-tooltip-trigger="hover">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mr-3 fill-gray-600 dark:fill-gray-400">
                                <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                            </svg>  
                        </a>
                        <div id="tooltip-edit-hover-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700" style="font-size: 10px">
                            Edit
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div> 

                        {{-- Delete --}}
                        <button data-modal-target="delete-modal-{{ $absen->id_absen }}" data-modal-toggle="delete-modal-{{ $absen->id_absen }}" data-tooltip-target="tooltip-delete-hover-{{ $loop->index }}" data-tooltip-trigger="hover">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-600 dark:fill-gray-400">
                                <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                            </svg>
                        </button>   
                        <div id="tooltip-delete-hover-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700" style="font-size: 10px">
                            Delete
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        
                        {{-- Pop Up --}}
                        <div id="delete-modal-{{ $absen->id_absen }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ml-24">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $absen->id_absen }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin menghapus presensi ini?</h3>
                                        <div class="flex justify-center">
                                            <form method="POST" action="{{ route('delete_absen', ['id_absen' => $absen->id_absen]) }}">
                                                @csrf
                                                <button data-modal-hide="delete-modal-{{ $absen->id_absen }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-xs inline-flex items-center px-5 py-2.5 text-center me-2">
                                                    Ya
                                                </button>
                                            </form>
                                            <button data-modal-hide="delete-modal-{{ $absen->id_absen }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-xs font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="flex mb-3 text-xs font-normal text-gray-600 dark:text-gray-400">
                    <div class="text-xs font-medium">Open
                        <span class="bg-green-100 text-green-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 ml-0.5" style="font-size: 10px">
                            {{ \Carbon\Carbon::parse($absen->mulai_absen)->format('Y-m-d H:i') }}
                        </span>
                    </div>
                    <div class="text-xs font-medium ml-0.5">Due to
                        <span class="bg-pink-100 text-pink-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300 ml-0.5" style="font-size: 10px">
                            {{ \Carbon\Carbon::parse($absen->selesai_absen)->format('Y-m-d H:i') }}
                        </span>
                    </div>
                </div>
                <div class="items-center block p-3 sm:flex"> 
                    <img class="w-12 h-12 me-3 rounded-full sm:mb-0" src="{{ Auth::user()->getImageURL() }}" alt="Jese Leos image"/>  
                    <div class="w-full">
                        <h1 class="font-bold text-gray-900 dark:text-white" style="font-size: 13px">Sesi {{ $absen->sesi }}</h1>
                        <div class="font-normal text-gray-600 dark:text-gray-400" style="font-size: 11px">{{ $absen->deskripsi }}</div> 
                        <div class="flex items-center mt-3">
                            {{-- Rekap Mahasiswa --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-600 dark:fill-gray-400">
                                <path fill-rule="evenodd" d="M8.914 6.025a.75.75 0 0 1 1.06 0 3.5 3.5 0 0 1 0 4.95l-2 2a3.5 3.5 0 0 1-5.396-4.402.75.75 0 0 1 1.251.827 2 2 0 0 0 3.085 2.514l2-2a2 2 0 0 0 0-2.828.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M7.086 9.975a.75.75 0 0 1-1.06 0 3.5 3.5 0 0 1 0-4.95l2-2a3.5 3.5 0 0 1 5.396 4.402.75.75 0 0 1-1.251-.827 2 2 0 0 0-3.085-2.514l-2 2a2 2 0 0 0 0 2.828.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('rekap_mhs_admin', ['id_absen' => $absen->id_absen]) }}" class="ml-1 bg-blue-100 text-blue-800 font-semibold me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300 inline-flex items-center justify-center" style="font-size: 10px">Rekapitulasi Mahasiswa</a>

                            {{-- Status --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 ml-2 fill-gray-600 dark:fill-gray-400">
                                <path d="M5.75 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM5 10.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM10.25 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM7.25 8.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM8 9.5A.75.75 0 1 0 8 11a.75.75 0 0 0 0-1.5Z" />
                                <path fill-rule="evenodd" d="M4.75 1a.75.75 0 0 0-.75.75V3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2V1.75a.75.75 0 0 0-1.5 0V3h-5V1.75A.75.75 0 0 0 4.75 1ZM3.5 7a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v4.5a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1V7Z" clip-rule="evenodd" />
                            </svg>
                            @if ($isInTimeRange)
                                <span class="ml-1 bg-yellow-100 text-yellow-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300" style="font-size: 10px">Aktif</span>
                            @else
                                <span class="ml-1 bg-gray-200 text-gray-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300" style="font-size: 10px">Tidak Aktif</span>
                            @endif

                            {{-- Rekap verifikasi --}}
                            <div class="flex ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-600 dark:fill-gray-400">
                                    <path d="M8 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5ZM3.156 11.763c.16-.629.44-1.21.813-1.72a2.5 2.5 0 0 0-2.725 1.377c-.136.287.102.58.418.58h1.449c.01-.077.025-.156.045-.237ZM12.847 11.763c.02.08.036.16.046.237h1.446c.316 0 .554-.293.417-.579a2.5 2.5 0 0 0-2.722-1.378c.374.51.653 1.09.813 1.72ZM14 7.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM3.5 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM5 13c-.552 0-1.013-.455-.876-.99a4.002 4.002 0 0 1 7.753 0c.136.535-.324.99-.877.99H5Z" />
                                </svg>   
                                <h1 class="ml-1 font-medium text-gray-600 dark:text-gray-400" style="font-size: 11px">Presensi yang belum diverifikasi: {{ $absen->unverified_count }}</h1>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const search = document.getElementById("search");
            const cards = document.querySelectorAll(".card");

            search.addEventListener("input", (e) => searchData(e.target.value));

            function searchData(search) {
                cards.forEach((card) => {
                    const cardContent = card.innerText || card.textContent;
                    if (cardContent.toLowerCase().includes(search.toLowerCase())) {
                        card.classList.remove("d-none");
                    } else {
                        card.classList.add("d-none");
                    }
                });
            }

            search.addEventListener("input", () => {
                const searchTerm = search.value.trim().toLowerCase();
                cards.forEach((card) => {
                    const cardContent = card.innerText || card.textContent;
                    if (cardContent.toLowerCase().includes(searchTerm)) {
                        card.classList.remove("d-none");
                    } else {
                        card.classList.add("d-none");
                    }
                });
            });
        });
    </script>
</body>
@endsection