@extends('index_mentor')
@section('title', 'Penilaian')

@section('isihalaman')
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
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
            <div id="notification-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-900 dark:text-red-800" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-900 dark:text-red-800 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
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

        <nav class="bg-zinc-100 border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg mb-3">
            {{-- Welcome User --}}
            <div class="flex p-2.5">
                <div class="ml-1 flex items-center">
                    <p class="self-center text-sm font-semibold whitespace-nowrap text-black dark:text-white ml-1">Penilaian Mahasiswa Magang</p>
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

        <div class="grid grid-cols-7 gap-3">
            {{-- Profile --}}
            <div class="col-span-3 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow">
                {{-- Foto --}}
                <div class="flex items-center py-4 px-5">
                    <img src="{{ $foto }}" alt="user photo" class="w-24 h-24 object-cover rounded-full ml-1"/>
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
                </div>
            </div>

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

                // Progress
                $jumlahHariProgress = $mulaiMagang->diffInDaysFiltered(function($date) {
                    return $date; 
                }, $selesaiMagang->addDay());

                $jumlahMinggu = ceil($jumlahHariProgress / 7); // ceil => pembulatan ke atas
            @endphp

            {{-- Persentase Absen --}}
            <div class="col-span-2 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow">
                <div class="flex items-center py-4 px-5">
                    <div class="space-y-0.5">
                        <h1 class="text-xs font-medium dark:text-white">Rekapitulasi Pengisian Presensi</h1>
                        <p class="text-2xl font-semibold text-purple-600 dark:text-purple-500">{{ number_format((($absenPagi->count() + $absenSore->count())/$jumlahPresensi)*100, 2) }}%</p>
                        <p class="text-gray-700 dark:text-gray-400" style="font-size: 9px">* Sesi pagi + sore dengan status 'Verified'</p>
                    </div>
                    <img src="{{ asset('assets/pres2.png') }}" alt="user photo" class="w-20 h-20 object-cover rounded-full mt-1"/>
                </div>
            </div>

            {{-- Persentase Progress --}}
            <div class="col-span-2 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow">
                <div class="flex items-center py-4 px-5">
                    <div class="space-y-0.5">
                        <h1 class="text-xs font-medium dark:text-white">Rekapitulasi Pengisian Progress</h1>
                        <p class="text-2xl font-semibold text-purple-600 dark:text-purple-500">{{ number_format(($progVer->count()/$jumlahMinggu)*100, 2)}}%</p>
                        <p class="text-gray-700 dark:text-gray-400" style="font-size: 9px">* Semua progress dengan status 'Verified'</p>
                    </div>
                    <img src="{{ asset('assets/prog2.png') }}" alt="user photo" class="w-16 h-16 object-cover rounded-full"/>
                </div>
            </div>
        </div>

        <div class="p-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 rounded-lg shadow mt-3">
            <!-- Tabel Penilaian Magang -->
            <div>
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="border dark:border-gray-800 text-xs text-black uppercase bg-gray-100 dark:bg-gray-900 dark:text-white">
                        <tr>
                            <th class="py-3 px-4 text-center border dark:border-black">Nomor</th>
                            <th class="py-3 px-4 text-left border dark:border-black">Kriteria Penilaian</th>
                            <th class="py-3 px-4 text-left border dark:border-black">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800 dark:text-gray-200 border dark:border-gray-800 text-xs font-medium">
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-800">
                            <td class="py-3 px-4 text-center border dark:border-black">1</td>
                            <td class="py-3 px-4 border dark:border-black">Kedisiplinan dan Etika</td>
                            <td class="py-3 px-4 border dark:border-black">
                                <input type="text" id="nilai1" name="nilai1" value="{{ $nilai->nilai1 }}" aria-label="disabled input" class="w-full border rounded py-1 px-2 dark:bg-gray-700 text-xs text-center bg-gray-100 border-gray-300 text-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400" disabled>
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-800">
                            <td class="py-3 px-4 text-center border dark:border-black">2</td>
                            <td class="py-3 px-4 border dark:border-black">Kemampuan Berkomunikasi dan Bekerja Sama</td>
                            <td class="py-3 px-4 border dark:border-black">
                                <input type="text" id="nilai2" name="nilai2" value="{{ $nilai->nilai2 }}" aria-label="disabled input" class="w-full border rounded py-1 px-2 dark:bg-gray-700 text-xs text-center bg-gray-100 border-gray-300 text-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400" disabled>
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-800">
                            <td class="py-3 px-4 text-center border dark:border-black">3</td>
                            <td class="py-3 px-4 border dark:border-black">Pemahaman terhadap Permasalahan</td>
                            <td class="py-3 px-4 border dark:border-black">
                                <input type="text" id="nilai3" name="nilai3" value="{{ $nilai->nilai3 }}" aria-label="disabled input" class="w-full border rounded py-1 px-2 dark:bg-gray-700 text-xs text-center bg-gray-100 border-gray-300 text-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400" disabled>
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-800">
                            <td class="py-3 px-4 text-center border dark:border-black">4</td>
                            <td class="py-3 px-4 border dark:border-black">Pengetahuan Teoritis dan Praktik</td>
                            <td class="py-3 px-4 border dark:border-black">
                                <input type="text" id="nilai4" name="nilai4" value="{{ $nilai->nilai4 }}" aria-label="disabled input" class="w-full border rounded py-1 px-2 dark:bg-gray-700 text-xs text-center bg-gray-100 border-gray-300 text-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400" disabled>
                            </td>
                        </tr>
                    </tbody>
                    <tbody> 
                        <tr>
                            <td class="py-2 px-4 border-b border-l text-center dark:border-black"></td>
                            <td class="dark:text-white py-2 px-4 border-b font-bold dark:border-black">Rata-rata</td>
                            <td class="py-2 px-4 border-b border-r dark:border-black">
                                <div class="text-center font-bold dark:text-white">{{ $nilai->nilai_avg }}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex mt-3">
                    {{-- Kembali --}}
                    <a href="{{ route('daftar_mhs_mentor') }}" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700">
                        <button type="button" class="w-full h-full">
                            Kembali
                        </button>
                    </a> 

                    {{-- Edit --}}
                    <form action="{{ route('edit_nilai_mentor_access', ['id_mhs' => $mahasiswa->id_mhs]) }}" method="post" class="ml-auto">
                        @csrf
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 dark:bg-blue-600 dark:hover:bg-blue-700 -mr-0.5 flex items-center align-middle px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 mr-1">
                                <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                            </svg>  
                            Edit
                        </button>
                    </form>

                    {{-- Hapus --}}
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ml-2 flex items-center px-2.5" data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3 h-3 mr-1">
                            <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                        </svg>
                        Hapus
                    </button>

                    {{-- Pop Up Delete Modal --}}
                    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ml-24">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin menghapus penilaian ini?</h3>
                                    <div class="flex justify-center">
                                        <form method="POST" action="{{ route('delete_nilai', ['id_mhs' => $mahasiswa->id_mhs]) }}">
                                            @csrf
                                            <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-xs inline-flex items-center px-5 py-2.5 text-center me-2">
                                                Ya
                                            </button>
                                        </form>
                                        <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-xs font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
