<aside id="logo-sidebar" class="fixed z-40 w-64 h-screen flex flex-col transition-transform -translate-x-full sm:translate-x-0 font-poppins overflow-hidden bg-zinc-100 dark:bg-gray-900 overflow-y-auto" aria-label="Sidebar">
   {{-- Logo dan Header --}}
   <div class="flex items-center ps-2.5 mt-5 mb-3 ml-5">
      <a href="https://diskominfo.semarangkota.go.id/">
            <img src="{{ asset('assets/logo.png') }}" class="h-6 me-3 sm:h-12" alt="Diskominfo Logo"/>
      </a>
      <p class="self-center text-xl font-bold whitespace-nowrap text-black dark:text-white">SINFORMA <br> Diskominfo </p>
   </div>

   <ul class="space-y-1 text-sm font-medium ml-4">
      {{-- Dashboard --}}
      <li>
         <a href="{{ route('dashboard_admin') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
            </svg>
            
            <span class="ms-3">Dashboard</span>
         </a>
      </li>

      {{-- Profile --}}
      <li>
         <a href="{{ route('view_profil') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
            </svg>
            
            <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
         </a>
      </li>

      {{-- Tambah Mahasiswa --}}
      <li>
         <div class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 mr-5 dark:hover:bg-gray-700 group cursor-pointer" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
               <path d="M8.5 4.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 13c.552 0 1.01-.452.9-.994a5.002 5.002 0 0 0-9.802 0c-.109.542.35.994.902.994h8ZM12.5 3.5a.75.75 0 0 1 .75.75v1h1a.75.75 0 0 1 0 1.5h-1v1a.75.75 0 0 1-1.5 0v-1h-1a.75.75 0 0 1 0-1.5h1v-1a.75.75 0 0 1 .75-.75Z" />
            </svg>                 
            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Tambah Mahasiswa</span>
            <svg class="mr-2 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
         </div>
         <ul id="dropdown-example" class="hidden mr-5 text-xs pl-10">
            <li>
               <a href="{{ route('entry_mhs') }}" class="flex items-center py-1 text-gray-900 rounded-lg group dark:text-white hover:text-purple-500">Generate Akun</a>
            </li>
            <li>
               <a href="{{ route('daftar_akun') }}" class="flex items-center mt-2 mb-2 text-gray-900 rounded-lg group dark:text-white hover:text-purple-500">Daftar Akun</a>
            </li>
         </ul>
      </li>

      {{-- Daftar Mahasiswa --}}
      <li>
         <a href="{{ route('daftar_mhs') }}" class="flex items-center p-2 text-gray-900 hover:mr-5 rounded-lg dark:text-white hover:bg-purple-300 dark:hover:bg-gray-700 group">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" d="M6 4.75A.75.75 0 0 1 6.75 4h10.5a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 4.75ZM6 10a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 10Zm0 5.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H6.75a.75.75 0 0 1-.75-.75ZM1.99 4.75a1 1 0 0 1 1-1H3a1 1 0 0 1 1 1v.01a1 1 0 0 1-1 1h-.01a1 1 0 0 1-1-1v-.01ZM1.99 15.25a1 1 0 0 1 1-1H3a1 1 0 0 1 1 1v.01a1 1 0 0 1-1 1h-.01a1 1 0 0 1-1-1v-.01ZM1.99 10a1 1 0 0 1 1-1H3a1 1 0 0 1 1 1v.01a1 1 0 0 1-1 1h-.01a1 1 0 0 1-1-1V10Z" clip-rule="evenodd" />
            </svg>

            <span class="flex-1 ms-3 whitespace-nowrap">Daftar Mahasiswa</span>
         </a>
      </li>

      {{-- Presensi --}}
      <li>
         <div class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 mr-5 dark:hover:bg-gray-700 group cursor-pointer" aria-controls="dropdown-example1" data-collapse-toggle="dropdown-example1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
               <path fill-rule="evenodd" d="M15.988 3.012A2.25 2.25 0 0 1 18 5.25v6.5A2.25 2.25 0 0 1 15.75 14H13.5V7A2.5 2.5 0 0 0 11 4.5H8.128a2.252 2.252 0 0 1 1.884-1.488A2.25 2.25 0 0 1 12.25 1h1.5a2.25 2.25 0 0 1 2.238 2.012ZM11.5 3.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 .75.75v.25h-3v-.25Z" clip-rule="evenodd" />
               <path fill-rule="evenodd" d="M2 7a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7Zm2 3.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Zm0 3.5a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Presensi</span>
            <svg class="mr-2 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
         </div>
         <ul id="dropdown-example1" class="hidden mr-5 text-xs pl-10">
            <li>
               <a href="{{ route('tambah_absen') }}" class="flex items-center py-1 text-gray-900 rounded-lg group dark:text-white hover:text-purple-500">Generate Presensi</a>
            </li>
            <li>
               <a href="{{ route('rekap_presensi') }}" class="flex items-center mt-2 mb-2 text-gray-900 rounded-lg group dark:text-white hover:text-purple-500">Rekapitulasi Presensi</a>
            </li>
         </ul>
      </li>

      {{-- SKL --}}
      <li>
         <a href="{{ route('skl_mhs') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
               <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h9A1.5 1.5 0 0 1 14 3.5v11.75A2.75 2.75 0 0 0 16.75 18h-12A2.75 2.75 0 0 1 2 15.25V3.5Zm3.75 7a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5Zm0 3a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5ZM5 5.75A.75.75 0 0 1 5.75 5h4.5a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 5 8.25v-2.5Z" clip-rule="evenodd" />
               <path d="M16.5 6.5h-1v8.75a1.25 1.25 0 1 0 2.5 0V8a1.5 1.5 0 0 0-1.5-1.5Z" />
            </svg>

            <span class="flex-1 ms-3 whitespace-nowrap">SKL</span>
         </a>
      </li>

      {{-- Berita Acara --}}
      <li>
         <a href="{{ route('view_berita') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="flex-shrink-0 w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
            <path d="M13.407 2.59a.75.75 0 0 0-1.464.326c.365 1.636.557 3.337.557 5.084 0 1.747-.192 3.448-.557 5.084a.75.75 0 0 0 1.464.327c.264-1.185.444-2.402.531-3.644a2 2 0 0 0 0-3.534 24.736 24.736 0 0 0-.531-3.643ZM4.348 11H4a3 3 0 0 1 0-6h2c1.647 0 3.217-.332 4.646-.933C10.878 5.341 11 6.655 11 8c0 1.345-.122 2.659-.354 3.933a11.946 11.946 0 0 0-4.23-.925c.203.718.478 1.407.816 2.057.12.23.057.515-.155.663l-.828.58a.484.484 0 0 1-.707-.16A12.91 12.91 0 0 1 4.348 11Z" />
         </svg>             
            <span class="flex-1 ms-3 whitespace-nowrap">Event</span>
         </a>
      </li>
   </ul>

   {{-- Maskot --}}
   <div class="flex-grow flex items-end mt-3">
      <img src="{{ asset('assets/maskot_admin2.png') }}" alt="Maskot" class="w-full h-auto" />  
   </div>
</aside>