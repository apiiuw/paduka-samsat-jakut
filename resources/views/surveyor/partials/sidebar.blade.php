<aside id="logo-sidebar" class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="flex justify-center items-center py-3 bg-[#42485D]">
      <img class="h-16" src="{{ asset('img/jasa-raharja/logo/logo-paduka.png') }}" alt="">
      <img class="h-16" src="{{ asset('img/unit-laka-samsat/logo/logo-samsat.png') }}" alt="">
   </div>
   <div class="h-full px-3 pb-4 pt-5 overflow-y-auto bg-[#373D53]">
      <div class="flex flex-col text-left text-[#ADB7C1] border-b border-[#ADB7C1] pb-3 mb-3">
         <h1 class="text-md font-semibold">DASHBOARD</h1>
         <h3 class="text-xs">Petugas Survei (Wilayah)</h3>
      </div>
      <ul class="space-y-2 font-medium">
         <li>
            <a href="/surveyor-data-survei" 
               class="flex items-center p-2 rounded-lg group
                  {{ request()->is('surveyor-data-survei') ? 'text-white bg-blueJR' : 'text-[#ADB7C1] hover:text-white hover:bg-blueJRdark' }}">
               <i class="fa-solid fa-car fa-lg transition duration-75 group-hover:text-white"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Data Wajib Survei</span>
            </a>
         </li>
         <li>
            <a href="/surveyor-data-hasil-survei" 
               class="flex items-center p-2 rounded-lg group
                  {{ request()->is('surveyor-data-hasil-survei') ? 'text-white bg-blueJR' : 'text-[#ADB7C1] hover:text-white hover:bg-blueJRdark' }}">
               <i class="fa-solid fa-file fa-lg transition duration-75 group-hover:text-white"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Data Hasil Survei</span>
            </a>
         </li>
         <li>
            <a href="/surveyor-input-data-survei" 
               class="flex items-center p-2 rounded-lg group
                  {{ request()->is('surveyor-input-data-survei') ? 'text-white bg-blueJR' : 'text-[#ADB7C1] hover:text-white hover:bg-blueJRdark' }}">
               <i class="fa-solid fa-square-plus fa-lg transition duration-75 group-hover:text-white"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Input Data Survei</span>
            </a>
         </li>
      </ul>
   </div>
</aside>