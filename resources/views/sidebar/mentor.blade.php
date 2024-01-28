<aside id="logo-sidebar" class="fixed z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 font-poppins" aria-label="Sidebar">
   {{-- Sidebar --}}
   <div class="h-full overflow-hidden bg-zinc-100 dark:bg-gray-800">
      {{-- Logo dan Header --}}
      <div class="flex items-center ps-2.5 mb-5 ml-5 mt-5">
         <a href="https://diskominfo.semarangkota.go.id/">
            <img src="assets/logo.png" class="h-6 me-3 sm:h-12" alt="Diskominfo Logo"/>
         </a>
         <p class="self-center text-xl font-bold whitespace-nowrap">SIPRESMA <br> Diskominfo </p>
      </div>

      <ul class="space-y-2 font-medium ml-4">
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
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
               </svg>
               
               <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
            </a>
         </li>
        
        {{-- Tambah Progress --}}
        <li>
            <a href="{{ route('tambah_progress') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-purple-300 hover:mr-5 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
               </svg>
               
               <span class="flex-1 ms-3 whitespace-nowrap">Tambah Progress</span>
            </a>
         </li>

         {{-- Daftar Mahasiswa --}}
         <li>
            <a href="{{ route('daftar_mhs_mentor') }}" class="flex items-center p-2 text-gray-900 hover:mr-5 rounded-lg dark:text-white hover:bg-purple-300 dark:hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M6 4.75A.75.75 0 0 1 6.75 4h10.5a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 4.75ZM6 10a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 10Zm0 5.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H6.75a.75.75 0 0 1-.75-.75ZM1.99 4.75a1 1 0 0 1 1-1H3a1 1 0 0 1 1 1v.01a1 1 0 0 1-1 1h-.01a1 1 0 0 1-1-1v-.01ZM1.99 15.25a1 1 0 0 1 1-1H3a1 1 0 0 1 1 1v.01a1 1 0 0 1-1 1h-.01a1 1 0 0 1-1-1v-.01ZM1.99 10a1 1 0 0 1 1-1H3a1 1 0 0 1 1 1v.01a1 1 0 0 1-1 1h-.01a1 1 0 0 1-1-1V10Z" clip-rule="evenodd" />
               </svg>

               <span class="flex-1 ms-3 whitespace-nowrap">Daftar Mahasiswa</span>
            </a>
         </li>
      </ul> 

     <!-- <footer>
        {{-- Maskot --}}
        <img src="assets/maskot_2.png" class="mt-10" alt="Maskot"/>   
     </footer>    -->
  </div>
</aside>
