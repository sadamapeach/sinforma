@extends('index_admin')
@section('title', 'Dashboard')

@section('isihalaman')
<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])  
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="font-poppins">  
    <div class="p-4 sm:ml-64">
        <nav class="bg-zinc-100 border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-xl">
            {{-- Welcome User --}}
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
                <p class="self-center text-base font-semibold whitespace-nowrap text-black dark:text-white ml-2">Hello, {{ $admin->nama }} 👋</p>
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
                        <li>
                            <a href="{{ route ('account.viewChangePassword') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-black dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Change Password</a>
                        </li>
                        <li>
                            <form action="/logout" method="post"
                                class="block h-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-red"
                                role="menuitem">
                                @csrf
                                <button type="submit" class="h-full w-full text-left">Sign out</button>
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

    {{-- Profile --}}
    <div class="px-4 sm:ml-64">
        <div class="flex space-x-4">
        <div class="block max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-1/2 h-56">
            {{-- Header Card --}}
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-zinc-100 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                <li class="me-2">
                    <p class="font-bold text-black dark:text-white py-1.5 px-6 text-base">Profile</p>
                </li>
            </ul>

            {{-- Foto --}}
            <figcaption class="flex items-center p-6">
                <img class="rounded-full w-32 h-32" src="{{ Auth::user()->getImageURL() }}" alt="profile picture">
                <div class="space-y-2.5 text-left rtl:text-right mx-4">
                    <div class="text-black dark:text-white text-sm font-bold">{{ $admin->nama }}</div>
                    <div class="text-xs text-gray-700 dark:text-gray-400">Admin SINFORMA Diskominfo</div>
                    {{-- Alamat --}}
                    <div class="flex items-center">
                        <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                            <path fill-rule="evenodd" d="M7.605 2.112a.75.75 0 0 1 .79 0l5.25 3.25A.75.75 0 0 1 13 6.707V12.5h.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H3V6.707a.75.75 0 0 1-.645-1.345l5.25-3.25ZM4.5 8.75a.75.75 0 0 1 1.5 0v3a.75.75 0 0 1-1.5 0v-3ZM8 8a.75.75 0 0 0-.75.75v3a.75.75 0 0 0 1.5 0v-3A.75.75 0 0 0 8 8Zm2 .75a.75.75 0 0 1 1.5 0v3a.75.75 0 0 1-1.5 0v-3ZM8 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                        </svg></span>
                        <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $admin->alamat}}</span>
                    </div>
                    {{-- No.HP --}}
                    <div class="flex">
                        <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 fill-gray-700 dark:fill-gray-400">
                            <path fill-rule="evenodd" d="m3.855 7.286 1.067-.534a1 1 0 0 0 .542-1.046l-.44-2.858A1 1 0 0 0 4.036 2H3a1 1 0 0 0-1 1v2c0 .709.082 1.4.238 2.062a9.012 9.012 0 0 0 6.7 6.7A9.024 9.024 0 0 0 11 14h2a1 1 0 0 0 1-1v-1.036a1 1 0 0 0-.848-.988l-2.858-.44a1 1 0 0 0-1.046.542l-.534 1.067a7.52 7.52 0 0 1-4.86-4.859Z" clip-rule="evenodd" />
                        </svg></span>
                        <span class="text-xs text-gray-700 dark:text-gray-400 ml-2">{{ $admin->no_telepon }}</span>
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
                                    <h1 class="text-3xl font-bold text-yellow-400 dark:text-yellow-300">{{ count($mahasiswa) }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 9px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-2">
                                    <img class="h-14 w-14" src="assets/total.png" alt="image description">
                                </div>
                            </div>

                            {{-- Aktif --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-green-200 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Status: Aktif</h1>
                                    <h1 class="text-3xl font-bold text-green-700 dark:text-green-500">{{ $mahasiswa->where('status', 'Aktif')->count() }}</h1>
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
                                <div class="bg-red-200 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Status: Tidak Aktif</h1>
                                    <h1 class="text-3xl font-bold text-pink-700 dark:text-pink-500">{{ $mahasiswa->where('status', 'Tidak Aktif')->count() }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-3">
                                    <img class="h-10 w-10" src="assets/tidak_aktif.png" alt="image description">
                                </div>
                            </div>
                            
                            {{-- Lulus --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-blue-200 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">Status: Lulus</h1>
                                    <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-500">{{ $mahasiswa->where('status', 'Lulus')->count() }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-3">
                                    <img class="h-10 w-10" src="assets/lulus.png" alt="image description">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-rows-2 gap-3">
                            {{-- Sudah Terbit SKL --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-gray-300 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">SKL: Sudah Terbit</h1>
                                    <h1 class="text-3xl font-bold text-gray-500 dark:text-gray-400">{{ count($skl1) }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-3">
                                    <img class="h-12 w-12" src="assets/sudah_nilai.png" alt="image description">
                                </div>
                            </div>
                            
                            {{-- Belum Terbit SKL --}}
                            <div class="flex bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height: 98px">
                                <div class="bg-purple-200 w-1 rounded h-1/3 ml-2 mt-3"></div>
                                <div class="self-center ml-2">
                                    <h1 class="text-xs font-bold text-black dark:text-white">SKL: Belum Terbit</h1>
                                    <h1 class="text-3xl font-bold text-purple-700 dark:text-purple-500">{{ count($skl2) }}</h1>
                                    <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                                </div>
                                <div class="ml-auto self-center mr-2">
                                    <img class="h-14 w-14" src="assets/belum_nilai.png" alt="image description">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
            <div class="flex space-x-4">
                <!-- Verifikasi Presensi -->
                <div class="block max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-1/2 h-56">
                        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-zinc-100 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="verifikasiPresensiTab" role="tablist">
                            <li class="me-2">
                                <p class="font-bold text-black dark:text-white py-1.5 px-6 text-base">Verifikasi Presensi</p>
                            </li>
                        </ul>

                        <figcaption class="flex items-center p-6">
                            <div class="space-y-2.5 text-left rtl:text-right mx-4">
                                <div class="text-xs text-gray-700 dark:text-gray-400">Mahasiswa yang harus diverifikasi:</div>
                                <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ count($mahasiswaVerifikasiPresensi) }}</div>
                                <p class="text-gray-400 dark:text-gray-500" style="font-size: 10px">Mahasiswa Magang</p>
                            </div>
                        </figcaption>
                </div>
                <!-- Carosel -->
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
                            <!-- ... (left button content) ... -->
                        </button>

                        <!-- Right Button -->
                        <button type="button" class="absolute top-28 end-0 z-30 flex items-center justify-center h-5 px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                            <!-- ... (right button content) ... -->
                        </button>
                    </div>
                </div>
            </div>
        </div>

            @foreach ($mahasiswa as $mhs)
            <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-4 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-2">{{ $mhs->nama }}</h2>

                {{-- Tampilkan informasi jumlah absen --}}
                <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah Absen: {{ $totalAbsen }}</p>

                {{-- Tampilkan informasi jumlah progress --}}
                <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah Progress: {{ $totalProgress }}</p>

                {{-- Tampilkan informasi lainnya sesuai kebutuhan --}}
                <!-- ... -->
            </div>
        @endforeach

    <script>
        // ApexCharts options and config
        window.addEventListener("load", function() {
            const getChartOptions = () => {
                const isDarkMode = document.querySelector('html').classList.contains('dark');
    
                const labelFontColor = isDarkMode ? "#ffffff" : "ffffff"; // Ganti dengan warna yang diinginkan
    
                return {
                    series: [80, 10, 5, 5],
                    colors: ["#1C64F2", "#16BDCA", "#E74694", "#FDBA8C"],
                    chart: {
                        height: 210,
                        width: "110%",
                        type: "donut",
                    },
                    stroke: {
                        colors: ["transparent"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontFamily: "poppins",
                                        offsetY: 17,
                                        style: {
                                            colors: [labelFontColor], // Warna font untuk nama
                                        },
                                    },
                                    total: {
                                        showAlways: true,
                                        show: true,
                                        label: "Total Kehadiran",
                                        fontFamily: "poppins",
                                        fontSize: "0.55rem",
                                        fontWeight: "bold",
                                        formatter: function (w) {
                                            const sum = w.globals.seriesTotals.reduce((a, b) => {
                                                return a + b
                                            }, 0)
                                            return `${sum}%`
                                        },
                                        style: {
                                            colors: [labelFontColor], // Warna font untuk total label
                                        },
                                    },
                                    value: {
                                        show: true,
                                        fontFamily: "poppins",
                                        offsetY: -15,
                                        formatter: function (value) {
                                            return value + "%"
                                        },
                                        style: {
                                            colors: [labelFontColor], // Warna font untuk nilai
                                        },
                                    },
                                },
                                size: "80%",
                            },
                        },
                    },
                    grid: {
                        padding: {
                            top: -2,
                        },
                    },
                    labels: ["Hadir", "Izin", "Sakit", "Alpha"],
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "poppins",
                        offsetY: -4,
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value + "%";
                            },
                            style: {
                                colors: [labelFontColor], // Warna font untuk label sumbu y
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function (value) {
                                return value + "%";
                            },
                            style: {
                                colors: [labelFontColor], // Warna font untuk label sumbu x
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                };
            };
    
            if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
                chart.render();
            }
        });
    </script>    
</body>
</html>
@endsection