@extends('index_mahasiswa')
@section('title', 'Dashboard')

@section('isihalaman')
<!DOCTYPE html>
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])  
</head>

<body class="font-poppins"> 
    <div class="p-4 sm:ml-64">
        <nav class="bg-zinc-100 border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg">
            {{-- Welcome User --}}
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
                <p class="self-center text-base font-semibold whitespace-nowrap text-black dark:text-white ml-2">Hello, {{ $mahasiswa->nama }} 👋</p>
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

        {{-- Alert --}}
        {{-- @if(session()->has('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                <span class="font-medium">Success alert!</span>{{ session('success') }}
                </div>
            </div>
        @endif --}}
    </div>

    <div class="px-4 sm:ml-64">
        <div class="flex space-x-4">
            {{-- Profile --}}
            <div class="block bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-2/5 h-56">
                {{-- Header Card --}}
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-zinc-100 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                    <li class="me-2">
                        <p class="font-bold text-black dark:text-white py-1.5 px-6 text-base">Profile</p>
                    </li>
                </ul>

                {{-- Foto --}}
                <figcaption class="flex items-center p-6">
                    <img class="rounded-full w-32 h-32" src="{{ Auth::user()->getImageURL() }}" alt="profile picture">
                    <div class="space-y-2.5 mx-4">
                        <div class="text-black dark:text-white text-sm font-bold">{{ $mahasiswa->nama }}</div>
                        <div class="text-xs text-gray-700 dark:text-gray-400">{{ $mahasiswa->jurusan }}</div>
                        {{-- University --}}
                        <div class="flex items-center">
                            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                <path fill-rule="evenodd" d="M7.605 2.112a.75.75 0 0 1 .79 0l5.25 3.25A.75.75 0 0 1 13 6.707V12.5h.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H3V6.707a.75.75 0 0 1-.645-1.345l5.25-3.25ZM4.5 8.75a.75.75 0 0 1 1.5 0v3a.75.75 0 0 1-1.5 0v-3ZM8 8a.75.75 0 0 0-.75.75v3a.75.75 0 0 0 1.5 0v-3A.75.75 0 0 0 8 8Zm2 .75a.75.75 0 0 1 1.5 0v3a.75.75 0 0 1-1.5 0v-3ZM8 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                            </svg></span>
                            <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $mahasiswa->instansi }}</span>
                        </div>
                        {{-- No.HP --}}
                        <div class="flex">
                            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                <path fill-rule="evenodd" d="m3.855 7.286 1.067-.534a1 1 0 0 0 .542-1.046l-.44-2.858A1 1 0 0 0 4.036 2H3a1 1 0 0 0-1 1v2c0 .709.082 1.4.238 2.062a9.012 9.012 0 0 0 6.7 6.7A9.024 9.024 0 0 0 11 14h2a1 1 0 0 0 1-1v-1.036a1 1 0 0 0-.848-.988l-2.858-.44a1 1 0 0 0-1.046.542l-.534 1.067a7.52 7.52 0 0 1-4.86-4.859Z" clip-rule="evenodd" />
                            </svg></span>
                            <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $mahasiswa->no_telepon }}</span>
                        </div>
                        {{-- Email --}}
                        <div class="flex">
                            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                                <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                            </svg></span>
                            <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $mahasiswa->email }}</span>
                        </div>
                    </div>
                </figcaption>  
            </div>

            {{-- Carosel --}}
            <div class="flex items-center justify-center rounded-lg bg-white w-3/5 h-56 dark:bg-gray-800">
                <div id="default-carousel" class="relative w-full h-56" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="assets/gojo_1.jpg" class="absolute w-full h-56 -translate-x-1/2 -translate-y-1/2 top-28 left-1/2 object-cover rounded-lg" alt="...">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="assets/gojo_3.jpg" class="absolute w-full h-56 -translate-x-1/2 -translate-y-1/2 top-28 left-1/2 object-cover rounded-lg" alt="...">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="assets/gojo_2.jpg" class="absolute w-full h-56 -translate-x-1/2 -translate-y-1/2 top-28 left-1/2 object-cover rounded-lg" alt="...">
                    </div>
                </div>

                <!-- Left Button -->
                <button type="button" class="absolute top-28 start-0 z-30 flex items-center justify-center h-5 px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-2 h-2 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>

                {{-- Right Button --}}
                <button type="button" class="absolute top-28 end-0 z-30 flex items-center justify-center h-5 px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-2 h-2 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-3 py-4">
            <div class="grid bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-60 content-center">
                <h5 class="mx-7 mb-4 text-base font-bold text-gray-900 dark:text-white">Informasi Magang</h5>

                {{-- Timeline --}}
                <div class="ml-14 mr-3">
                <ol class="relative border-s border-gray-300 dark:border-gray-700">                  
                    <li class="mb-4 ms-7">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-purple-300 rounded-full -start-3 ring-8 ring-purple-100 dark:ring-gray-900 dark:bg-purple-900">
                            <svg class="w-2.5 h-2.5 text-purple-800 dark:text-purple-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>
                        <h3 class="mb-1 text-xs font-semibold text-gray-900 dark:text-white">Mulai Magang</h3>
                        <time class="block text-xs font-normal leading-normal text-gray-400 dark:text-gray-500">Dimulai per tanggal {{ $mahasiswa->mulai_magang }}</time>
                    </li>
                    <li class="ms-7">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-purple-300 rounded-full -start-3 ring-8 ring-purple-100 dark:ring-gray-900 dark:bg-purple-900">
                            <svg class="w-2.5 h-2.5 text-purple-800 dark:text-purple-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>
                        <h3 class="mb-1 text-xs font-semibold text-gray-900 dark:text-white">Selesai Magang</h3>
                        <time class="block mb-2 text-xs font-normal leading-normal text-gray-400 dark:text-gray-500">Berakhir per tanggal {{ $mahasiswa->selesai_magang }}</time>
                    </li>
                </ol>
                </div>

                {{-- Status --}}
                <div class="mt-3 grid grid-flow-col auto-cols-min gap-2">
                    <div class="ml-7 text-xs text-black dark:text-white">Status</div>
                    <div class="text-xs text-black dark:text-white">:</div>
                    @if (trim($mahasiswa->status) == 'Aktif')
                        <div class="w-max text-center bg-green-100 text-green-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300" style="font-size: 10px">
                            Aktif
                        </div>
                    @else
                        @if (trim($mahasiswa->status) == 'Lulus')
                            <div class="w-max text-center bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300" style="font-size: 10px">
                                Lulus
                            </div>
                        @else
                            @if (trim($mahasiswa->status) == 'Tidak Aktif')
                                <div class="w-max text-center bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300" style="font-size: 10px">
                                    Tidak Lulus
                                </div>
                            @else
                                <div class="w-max text-center bg-purple-100 text-purple-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300" style="font-size: 10px">
                                    {{ $mahasiswa->status }}
                                </div>
                            @endif
                        @endif
                    @endif
                </div>

                {{-- Mentor --}}
                <div class="flex mt-2">
                    <div class="grid grid-flow-col auto-cols-min gap-1">
                        <div class="ml-7 text-xs text-black dark:text-white">Mentor</div>
                        <div class="text-xs text-black dark:text-white">:</div>
                    </div>
                    <div class="text-xs ml-2 text-black dark:text-white">{{ $mahasiswa->mentor_nama }}</div>
                </div>
            </div>

            {{-- Logic Perhitungan Presensi dan Progress --}}
            @php
                use Jenssegers\Date\Date;
                Date::setLocale('id');

                $mulaiMagang = \Carbon\Carbon::parse($mahasiswa->mulai_magang);
                $selesaiMagang = \Carbon\Carbon::parse($mahasiswa->selesai_magang);

                // Presensi
                $jumlahHariAbsen = $mulaiMagang->diffInDaysFiltered(function($date) {
                    return $date->isWeekday(); 
                }, $selesaiMagang->addDay());

                $jumlahPresensi = 2 * $jumlahHariAbsen; // Penyebut

                $totalAbsen = 0; // Pembilang
                if ($absen) {
                    $absenCollection = $absen->get();
                    $totalAbsen = $absenCollection
                        ->where('status', 'Verified')
                        ->count();
                }

                // Progress
                $jumlahHariProgress = $mulaiMagang->diffInDaysFiltered(function($date) {
                    return $date; 
                }, $selesaiMagang->addDay());

                $jumlahMinggu = ceil($jumlahHariProgress / 7); // ceil => pembulatan ke atas

                $totalProgress = 0;
                if ($progress) {
                    $progressCollection = $progress->get();
                    $totalProgress = $progressCollection
                        ->where('status', 'Verified')
                        ->count();
                }

                // echo "Jumlah : " . $totalAbsen;              
            @endphp

            <div class="grid grid-rows-2 gap-3">
                {{-- Presensi --}}
                <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 114px">
                    <div class="grid grid-cols-3">
                        <div class="py-4 pl-4">
                            <img class="h-20 w-20" src="assets/presensi.png" alt="image description">
                        </div>
                        <div class="text-left rtl:text-right mx-3 col-span-2">
                            <div class="text-black dark:text-white text-sm font-bold mt-4">Rekapitulasi Presensi</div>
                            <div class=" text-gray-400 dark:text-gray-500 mb-3" style="font-size: 10px">Wah, seberapa sering kamu absen?</div>
                            <div class="grid grid-cols-2">
                                <div class="text-xs font-medium text-purple-700 dark:text-purple-500 text-center border-r border-gray-700 dark:border-gray-500">
                                    Total <br> Kehadiran
                                </div>
                                <div class="text-2xl font-bold text-purple-700 dark:text-purple-500 ml-3">
                                    {{ number_format(($totalAbsen / $jumlahPresensi) * 100, 1) }}%
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>

                {{-- Progress --}}
                <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 114px">
                    <div class="grid grid-cols-3">
                        <div class="py-4 pl-4">
                            <img class="h-20 w-20" src="assets/progress.png" alt="image description">
                        </div>
                        <div class="text-left rtl:text-right mx-3 col-span-2">
                            <div class="text-black dark:text-white text-sm font-bold mt-4">Rekapitulasi Progress</div>
                            <div class=" text-gray-400 dark:text-gray-500 mb-2" style="font-size: 10px">Wah, sampai mana progress kamu?</div>
                            <div class="grid grid-cols-2">
                                <div class="text-xs font-medium text-purple-700 dark:text-purple-500 text-center border-r border-gray-700 dark:border-gray-500">
                                    Total <br> Pengiriman
                                </div>
                                <div class="text-2xl font-bold text-purple-700 dark:text-purple-500 ml-3">
                                    {{ number_format(($totalProgress / $jumlahMinggu) * 100, 1) }}%
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-rows-2 gap-3">
                {{-- SKL --}}
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 114px">
                    <div class="grid grid-cols-3">
                        <div class="py-4 pl-4">
                            <img class="h-20 w-20" src="assets/skl.png" alt="image description">
                        </div>
                        <div class="text-left rtl:text-right col-span-2">
                            <div class="text-black dark:text-white text-sm font-bold mt-4">Surat Keterangan Lulus</div>
                            <div class="text-gray-400 dark:text-gray-500 mb-2" style="font-size: 10px">
                                SKL dapat diunduh setelah mahasiswa dinyatakan LULUS.
                            </div>

                            {{-- Downloads --}}
                            <div class="flex items-center">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        class="w-4 h-4 fill-gray-700 dark:fill-gray-400">
                                        <path
                                            d="M8.75 2.75a.75.75 0 0 0-1.5 0v5.69L5.03 6.22a.75.75 0 0 0-1.06 1.06l3.5 3.5a.75.75 0 0 0 1.06 0l3.5-3.5a.75.75 0 0 0-1.06-1.06L8.75 8.44V2.75Z" />
                                        <path
                                            d="M3.5 9.75a.75.75 0 0 0-1.5 0v1.5A2.75 2.75 0 0 0 4.75 14h6.5A2.75 2.75 0 0 0 14 11.25v-1.5a.75.75 0 0 0-1.5 0v1.5c0 .69-.56 1.25-1.25 1.25h-6.5c-.69 0-1.25-.56-1.25-1.25v-1.5Z" />
                                    </svg>
                                </span>
                                @if ($skl)
                                    <a href="{{ route('cetak_skl_mhs') }}" class="bg-green-100 text-green-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 ml-1.5 z-30" style="font-size: 11px">Unduh SKL</a>
                                @else
                                    <span class="bg-pink-100 text-pink-800 font-medium me-2 px-2.5 content-center py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300 ml-1.5" style="font-size: 11px">Belum Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Nilai --}}
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 114px">
                    <div class="grid grid-cols-3">
                        <div class="py-4 pl-4">
                            <img class="h-20 w-20" src="assets/nilai.png" alt="image description">
                        </div>
                        <div class="text-left rtl:text-right col-span-2">
                            <div class="text-black dark:text-white text-sm font-bold mt-4">Penilaian Magang</div>
                            <div class=" text-gray-400 dark:text-gray-500 mb-2" style="font-size: 10px">
                                Penilaian dapat diunduh setelah mahasiswa menyelesaikan program.
                            </div>

                            {{-- Downloads --}}
                            <div class="flex items-center">
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 fill-gray-700 dark:fill-gray-400">
                                        <path d="M8.75 2.75a.75.75 0 0 0-1.5 0v5.69L5.03 6.22a.75.75 0 0 0-1.06 1.06l3.5 3.5a.75.75 0 0 0 1.06 0l3.5-3.5a.75.75 0 0 0-1.06-1.06L8.75 8.44V2.75Z" />
                                        <path d="M3.5 9.75a.75.75 0 0 0-1.5 0v1.5A2.75 2.75 0 0 0 4.75 14h6.5A2.75 2.75 0 0 0 14 11.25v-1.5a.75.75 0 0 0-1.5 0v1.5c0 .69-.56 1.25-1.25 1.25h-6.5c-.69 0-1.25-.56-1.25-1.25v-1.5Z" />
                                    </svg>
                                </span>
                                @if ($nilai)
                                    <a href="{{ route('cetak_nilai_mhs') }}" class="bg-green-100 text-green-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 ml-1.5" style="font-size: 11px">Unduh Penilaian</a>
                                @else
                                    <span class="bg-pink-100 text-pink-800 font-medium me-2 px-2.5 content-center py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300 ml-1.5" style="font-size: 11px">Belum Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>   
</body>
</html>
@endsection