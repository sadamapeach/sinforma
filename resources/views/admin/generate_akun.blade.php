@extends('index_admin')
@section('title', 'Tambah Akun')

@section('isihalaman')
<head>
    {{-- Reference Tailwind Flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
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
        <h1
            class="text-2xl mb-5 font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Generate Akun Mahasiswa 
        </h1>
        <div class=" overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                @if(count($mhsData) > 0)
                <form action="{{ route('generate_akun') }}" method="POST">
                    @csrf
                    <button type="submit" class="ml-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Generate Account</button>
                </form>   
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID 
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Instansi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jurusan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Mulai Magang
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Selesai Magang
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Mentor
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($mhsData as $mhs)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover-bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $mhs['id_mhs'] }}
                                </td>  
                                <td class="px-6 py-4">
                                    {{ $mhs['nama'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $mhs['instansi'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $mhs['jurusan'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $mhs['mulai_magang'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $mhs['selesai_magang'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $mhs['mentor'] }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif 
    </div>
</div>
</body>
@endsection