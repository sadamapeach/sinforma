<aside id="logo-sidebar" class="fixed z-40 w-64 h-screen flex flex-col transition-transform -translate-x-full sm:translate-x-0 font-poppins overflow-hidden bg-zinc-100 dark:bg-gray-800" aria-label="Sidebar">
   {{-- Logo dan Header --}}
   <div class="flex items-center ps-2.5 mb-5 ml-5 mt-5">
      <a href="https://diskominfo.semarangkota.go.id/">
         <img src="{{ asset('assets/logo.png') }}" class="h-6 me-3 sm:h-12" alt="Diskominfo Logo"/>
      </a>
      <p class="self-center text-xl font-bold whitespace-nowrap text-black dark:text-white">SINFORMA <br> Diskominfo </p>
   </div>

   <ul class="space-y-2 text-sm font-medium ml-4">
      {{-- Dashboard --}}
      <li>
         <a href="{{ route('dashboard_mentor') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
            </svg>
            
            <span class="ms-3">Dashboard</span>
         </a>
      </li>

      {{-- Profile --}}
      <li>
         <a href="{{ route('view_profil_mentor') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
            </svg>
            
            <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
         </a>
      </li>

      {{-- Tambah Progress --}}
      <li>
         <div class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 mr-5 dark:hover:bg-gray-700 group cursor-pointer" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                  <path fill-rule="evenodd" d="M11.986 3H12a2 2 0 0 1 2 2v6a2 2 0 0 1-1.5 1.937V7A2.5 2.5 0 0 0 10 4.5H4.063A2 2 0 0 1 6 3h.014A2.25 2.25 0 0 1 8.25 1h1.5a2.25 2.25 0 0 1 2.236 2ZM10.5 4v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75V4h3Z" clip-rule="evenodd" />
                  <path fill-rule="evenodd" d="M3 6a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H3Zm1.75 2.5a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5ZM4 11.75a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 0 1.5h-3.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
               </svg>
               <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Progress</span>
               <svg class="mr-2 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
               </svg>
         </div>
         <ul id="dropdown-example" class="hidden mr-5 text-xs pl-10">
               <li>
                  <a href="{{ route('tambah_progress') }}" class="flex items-center py-2 text-gray-900 rounded-lg group dark:text-white hover:text-purple-500">Generate Progress</a>
               </li>
               <li>
                  <a href="{{ route('rekap_progress') }}" class="flex items-center mt-2 mb-1 text-gray-900 rounded-lg group dark:text-white hover:text-purple-500">Rekapitulasi Progress</a>
               </li>
         </ul>
      </li>

      {{-- Daftar Mahasiswa --}}
      <li>
         <a href="{{ route('daftar_mhs_mentor') }}" class="flex items-center p-2 text-gray-900 hover:mr-5 rounded-lg dark:text-white hover:bg-purple-300 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
               <path d="M3 4.75a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6.25 3a.75.75 0 0 0 0 1.5h7a.75.75 0 0 0 0-1.5h-7ZM6.25 7.25a.75.75 0 0 0 0 1.5h7a.75.75 0 0 0 0-1.5h-7ZM6.25 11.5a.75.75 0 0 0 0 1.5h7a.75.75 0 0 0 0-1.5h-7ZM4 12.25a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM3 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" />
             </svg>             

            <span class="flex-1 ms-3 whitespace-nowrap">Daftar Mahasiswa</span>
         </a>
      </li>
   </ul> 
   
   {{-- Maskot --}}
   <div class="flex-grow flex items-end">
      <img src="{{ asset('assets/maskot_mentor.png') }}" alt="Maskot" class="w-full h-auto" />  
   </div>
</aside>
