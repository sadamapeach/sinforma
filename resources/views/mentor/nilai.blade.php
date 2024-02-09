@extends('index_mentor')
@section('title', 'Penilaian')

@section('isihalaman')
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <div class="p-4 sm:ml-64">
        <nav class="bg-zinc-100 border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg">
            {{-- Welcome User --}}
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2.5">
                <div class="ml-1 flex items-center">
                    <p class="self-center text-sm font-semibold whitespace-nowrap text-black dark:text-white ml-1">Penilaian Mahasiswa Magang</p>
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

        <!-- Informasi Mahasiswa -->
        <div class="flex flex-col items-center mb-6">
            <div class="relative w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <img src="{{ $foto }}" alt="user photo" class="w-24 h-24 object-cover" />
            </div>
            <br>
            <p class="text-sm font-semibold mt-2 text-gray-900 dark:text-white">{{ $mahasiswa->nama }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{$mahasiswa->id_mhs}} | {{ $mahasiswa->instansi }} | {{ $mahasiswa->jurusan }} | {{ $mahasiswa->status }}</p>
        </div>

        <!-- Tabel Penilaian Magang -->
        <form action="{{ route('store_nilai', ['id_mhs' => $mahasiswa->id_mhs]) }}" method="post">
            @csrf
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="border dark:border-gray-700 text-xs text-gray-800 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                    <tr>
                        <th class="py-3 px-4 text-center border dark:border-gray-700">Nomor</th>
                        <th class="py-3 px-4 text-left border dark:border-gray-700">Kriteria Penilaian</th>
                        <th class="py-3 px-4 text-left border dark:border-gray-700">Nilai</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 border dark:border-gray-700 text-xs font-medium">
                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-3 px-4 text-center border dark:border-gray-700">1</td>
                        <td class="py-3 px-4 border dark:border-gray-700">Kedisiplinan dan Etika</td>
                        <td class="py-3 px-4 border dark:border-gray-700">
                            <input type="number" name="nilai[]" class="w-full border rounded py-1 px-2 dark:bg-gray-700 text-xs">
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-3 px-4 text-center border dark:border-gray-700">2</td>
                        <td class="py-3 px-4 border dark:border-gray-700">Kemampuan Berkomunikasi dan Bekerja Sama</td>
                        <td class="py-3 px-4 border dark:border-gray-700">
                            <input type="number" name="nilai[]" class="w-full border rounded py-1 px-2 dark:bg-gray-700 text-xs">
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-3 px-4 text-center border dark:border-gray-700">3</td>
                        <td class="py-3 px-4 border dark:border-gray-700">Pemahaman terhadap Permasalahan</td>
                        <td class="py-3 px-4 border dark:border-gray-700">
                            <input type="number" name="nilai[]" class="w-full border rounded py-1 px-2 dark:bg-gray-700 text-xs">
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-3 px-4 text-center border dark:border-gray-700">4</td>
                        <td class="py-3 px-4 border dark:border-gray-700">Pengetahuan Teoritis dan Praktik</td>
                        <td class="py-3 px-4 border dark:border-gray-700">
                            <input type="number" name="nilai[]" class="w-full border rounded py-1 px-2 dark:bg-gray-700 text-xs">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-end mt-3">
                <button type="submit" name="submit" value="generate" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-md text-xs w-20 h-8 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
        
        @if (session('success'))
            <div class="p-4 mr-2 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>
</body>
@endsection
