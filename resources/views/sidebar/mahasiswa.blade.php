<aside id="logo-sidebar" class="fixed z-40 w-64 h-screen flex flex-col transition-transform -translate-x-full sm:translate-x-0 font-poppins overflow-hidden bg-zinc-100 dark:bg-gray-800" aria-label="Sidebar">
   {{-- Logo dan Header --}}
   <div class="flex items-center ps-2.5 mb-5 ml-5 mt-5">
      <a href="https://diskominfo.semarangkota.go.id/">
         <img src="{{ asset('assets/logo.png') }}" class="h-6 me-3 sm:h-12" alt="Diskominfo Logo"/>
      </a>
      <p class="self-center text-xl font-bold whitespace-nowrap text-black dark:text-white">SINFORMA <br> Diskominfo </p>
   </div>

   <ul class="space-y-2 font-medium ml-4">
      {{-- Dashboard --}}
      <li> 
         <a href="{{ route('dashboard_mahasiswa') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
            </svg>
            
            <span class="ms-3">Dashboard</span>
         </a>
      </li>

      {{-- Profile --}}
      <li>
         <a href="{{ route('profile_mahasiswa') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
               <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
            </svg>
            
            <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
         </a>
      </li>

      {{-- Presensi --}}
      <li>
         <a href="{{ route('presensi_mahasiswa') }}" class="flex items-center p-2 text-gray-900 hover:mr-5 rounded-lg dark:text-white hover:bg-purple-300 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
               <path fill-rule="evenodd" d="M15.988 3.012A2.25 2.25 0 0 1 18 5.25v6.5A2.25 2.25 0 0 1 15.75 14H13.5V7A2.5 2.5 0 0 0 11 4.5H8.128a2.252 2.252 0 0 1 1.884-1.488A2.25 2.25 0 0 1 12.25 1h1.5a2.25 2.25 0 0 1 2.238 2.012ZM11.5 3.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 .75.75v.25h-3v-.25Z" clip-rule="evenodd" />
               <path fill-rule="evenodd" d="M2 7a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7Zm2 3.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Zm0 3.5a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
            
            <span class="flex-1 ms-3 whitespace-nowrap">Presensi</span>
         </a>
      </li>

      {{-- Progress --}}
      <li>
         <a href="{{ route('progress_mahasiswa') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
               <path d="M15.5 2A1.5 1.5 0 0 0 14 3.5v13a1.5 1.5 0 0 0 1.5 1.5h1a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 16.5 2h-1ZM9.5 6A1.5 1.5 0 0 0 8 7.5v9A1.5 1.5 0 0 0 9.5 18h1a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 10.5 6h-1ZM3.5 10A1.5 1.5 0 0 0 2 11.5v5A1.5 1.5 0 0 0 3.5 18h1A1.5 1.5 0 0 0 6 16.5v-5A1.5 1.5 0 0 0 4.5 10h-1Z" />
            </svg>
            
            <span class="flex-1 ms-3 whitespace-nowrap">Progress</span>
         </a>
      </li>
   </ul> 

   {{-- Maskot --}}
   <div class="flex-grow flex items-end">
      <img src="{{ asset('assets/maskot_2.png') }}" alt="Maskot" class="w-full h-auto" />  
   </div>
</aside>