<aside
  :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
  class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
  @click.outside="sidebarToggle = false"
>
  <!-- SIDEBAR HEADER -->
  <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
    <a href="index.html">
      <img src="{{asset('src/img/logo/logo.png')}}" alt="Logo" />
    </a>

    <button
      class="block lg:hidden"
      @click.stop="sidebarToggle = !sidebarToggle"
    >
      <svg
        class="fill-current"
        width="20"
        height="18"
        viewBox="0 0 20 18"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
          fill=""
        />
      </svg>
    </button>
  </div>
  <!-- SIDEBAR HEADER -->

  <div
    class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear"
  >
    <!-- Sidebar Menu -->
    <nav
      class="mt-5 px-4 py-4 lg:mt-9 lg:px-6"
      x-data="{selected: $persist('Dashboard')}"
    >
      <!-- Menu Group -->
      <div class="text-white">
        <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU</h3>

        <ul class="space-y-2 font-medium">
          <li>
             <a href="{{ url('/dashboard') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-graydark dark:hover:bg-meta-4 group hover:text-white {{ request()->is('dashboard') ? 'bg-graydark text-white' : 'text-gray-500' }}">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white {{ request()->is('dashboard') ? 'bg-graydark text-white' : 'text-gray-500' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                   <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                   <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ml-3">Dashboard</span>
             </a>
          </li>
          <li>
             <a href="{{ url('/dashboard/user/presensi') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-graydark dark:hover:bg-meta-4 group hover:text-white {{ request()->is('dashboard/user/presensi') ? 'bg-graydark text-white' : 'text-gray-500' }}">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white {{ request()->is('dashboard/user/presensi') ? 'bg-graydark text-white' : 'text-gray-500' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
               </svg>                              
                <span class="flex-1 ml-3 whitespace-nowrap">Presensi</span>
             </a>
          </li>
          <li>
             <a href="{{ url('/dashboard/user/tugas') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-graydark dark:hover:bg-meta-4 group hover:text-white {{ request()->is('dashboard/user/tugas') ? 'bg-graydark text-white' : 'text-gray-500' }}">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white {{ request()->is('dashboard/user/tugas') ? 'bg-graydark text-white' : 'text-gray-500' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 17V2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M5 15V1m8 18v-4"/>
                </svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Tugas</span>
             </a>
          </li>
          <li>
            <a href="{{ url('/dashboard/user/profil') }}" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-graydark dark:hover:bg-meta-4 group hover:text-white {{ request()->is('dashboard/user/profil') ? 'bg-graydark text-white' : 'text-gray-500' }}">
            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white {{ request()->is('dashboard/user/profil') ? 'bg-graydark text-white' : 'text-gray-500' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>
            </svg>
               <span class="flex-1 ml-3 whitespace-nowrap">Profil</span>
            </a>
         </li>

         @if(auth()->user()->role->name === 'admin' || auth()->user()->role->name === 'superadmin')
          <li class="border-t">
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-500 transition duration-75 rounded-lg group hover:bg-graydark dark:hover:bg-meta-4 hover:text-white" aria-controls="dropdown-admin" data-collapse-toggle="dropdown-admin">
               <svg class="w-6 h-6 text-gray-500 group-hover:text-white" aria-hidden="true" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.5 8C5.80777 8 5.13108 7.79473 4.55551 7.41015C3.97993 7.02556 3.53133 6.47893 3.26642 5.83939C3.00152 5.19985 2.9322 4.49612 3.06725 3.81719C3.2023 3.13825 3.53564 2.51461 4.02513 2.02513C4.51461 1.53564 5.13825 1.2023 5.81719 1.06725C6.49612 0.932205 7.19985 1.00152 7.83939 1.26642C8.47893 1.53133 9.02556 1.97993 9.41015 2.55551C9.79473 3.13108 10 3.80777 10 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M6.5 17H1V15C1 13.9391 1.42143 12.9217 2.17157 12.1716C2.92172 11.4214 3.93913 11 5 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M19.5 11H18.38C18.2672 10.5081 18.0714 10.0391 17.801 9.613L18.601 8.818C18.6947 8.72424 18.7474 8.59708 18.7474 8.4645C18.7474 8.33192 18.6947 8.20476 18.601 8.111L17.894 7.404C17.8002 7.31026 17.6731 7.25761 17.5405 7.25761C17.4079 7.25761 17.2808 7.31026 17.187 7.404L16.392 8.204C15.9647 7.93136 15.4939 7.73384 15 7.62V6.5C15 6.36739 14.9473 6.24021 14.8536 6.14645C14.7598 6.05268 14.6326 6 14.5 6H13.5C13.3674 6 13.2402 6.05268 13.1464 6.14645C13.0527 6.24021 13 6.36739 13 6.5V7.62C12.5081 7.73283 12.0391 7.92863 11.613 8.199L10.818 7.404C10.7242 7.31026 10.5971 7.25761 10.4645 7.25761C10.3319 7.25761 10.2048 7.31026 10.111 7.404L9.404 8.111C9.31026 8.20476 9.25761 8.33192 9.25761 8.4645C9.25761 8.59708 9.31026 8.72424 9.404 8.818L10.204 9.618C9.9324 10.0422 9.73492 10.5096 9.62 11H8.5C8.36739 11 8.24021 11.0527 8.14645 11.1464C8.05268 11.2402 8 11.3674 8 11.5V12.5C8 12.6326 8.05268 12.7598 8.14645 12.8536C8.24021 12.9473 8.36739 13 8.5 13H9.62C9.73283 13.4919 9.92863 13.9609 10.199 14.387L9.404 15.182C9.31026 15.2758 9.25761 15.4029 9.25761 15.5355C9.25761 15.6681 9.31026 15.7952 9.404 15.889L10.111 16.596C10.2048 16.6897 10.3319 16.7424 10.4645 16.7424C10.5971 16.7424 10.7242 16.6897 10.818 16.596L11.618 15.796C12.0422 16.0676 12.5096 16.2651 13 16.38V17.5C13 17.6326 13.0527 17.7598 13.1464 17.8536C13.2402 17.9473 13.3674 18 13.5 18H14.5C14.6326 18 14.7598 17.9473 14.8536 17.8536C14.9473 17.7598 15 17.6326 15 17.5V16.38C15.4919 16.2672 15.9609 16.0714 16.387 15.801L17.182 16.601C17.2758 16.6947 17.4029 16.7474 17.5355 16.7474C17.6681 16.7474 17.7952 16.6947 17.889 16.601L18.596 15.894C18.6897 15.8002 18.7424 15.6731 18.7424 15.5405C18.7424 15.4079 18.6897 15.2808 18.596 15.187L17.796 14.392C18.0686 13.9647 18.2662 13.4939 18.38 13H19.5C19.6326 13 19.7598 12.9473 19.8536 12.8536C19.9473 12.7598 20 12.6326 20 12.5V11.5C20 11.3674 19.9473 11.2402 19.8536 11.1464C19.7598 11.0527 19.6326 11 19.5 11ZM14 14.5C13.5055 14.5 13.0222 14.3534 12.6111 14.0787C12.2 13.804 11.8795 13.4135 11.6903 12.9567C11.5011 12.4999 11.4516 11.9972 11.548 11.5123C11.6445 11.0273 11.8826 10.5819 12.2322 10.2322C12.5819 9.8826 13.0273 9.6445 13.5123 9.54804C13.9972 9.45157 14.4999 9.50108 14.9567 9.6903C15.4135 9.87952 15.804 10.2 16.0787 10.6111C16.3534 11.0222 16.5 11.5055 16.5 12C16.5 12.663 16.2366 13.2989 15.7678 13.7678C15.2989 14.2366 14.663 14.5 14 14.5Z" fill="currentColor"/>
               </svg>              
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Administrator</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            {{-- dashboard admin --}}
            <ul id="dropdown-admin" class="hidden py-2 space-y-2">
                  <li>
                     <a href="/dashboard/admin" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin') ? 'bg-graydark text-white' : 'text-gray-500' }}">Dashboard Admin</a>
                  </li>
                  <li>
                     <a href="/dashboard/admin/peserta" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/peserta') ? 'bg-graydark text-white' : 'text-gray-500' }}">Akun Peserta</a>
                  </li>
                  @if(auth()->user()->role->name === 'superadmin')
                  <li>
                     <a href="/dashboard/admin/akun-admin" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/akun-admin') ? 'bg-graydark text-white' : 'text-gray-500' }}">Akun Administrator</a>
                  </li>
                  @endif
                  <li>
                     <a href="/dashboard/admin/tugas" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/tugas') ? 'bg-graydark text-white' : 'text-gray-500' }}">Data Tugas</a>
                  </li>
                  <li>
                     <a href="/dashboard/admin/tugas/pengumpulan" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/tugas/pengumpulan') ? 'bg-graydark text-white' : 'text-gray-500' }}">Data Pengumpulan</a>
                  </li>
                  <li>
                     <a href="/dashboard/admin/kelompok" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/kelompok') ? 'bg-graydark text-white' : 'text-gray-500' }}">Data Kelompok</a>
                  </li>
                  @if(auth()->user()->role->name === 'superadmin')
                  <li>
                    <a href="/dashboard/admin/posisi" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/posisi') ? 'bg-graydark text-white' : 'text-gray-500' }}">Posisi Pengguna</a>
                 </li>
                 @endif
                  <li>
                     <a href="/dashboard/admin/news" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/news') ? 'bg-graydark text-white' : 'text-gray-500' }}">Berita</a>
                  </li>
                  <li>
                     <a href="/dashboard/admin/jenisketentuan" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/jenisketentuan') ? 'bg-graydark text-white' : 'text-gray-500' }}">Jenis Ketentuan</a>
                  </li>
                  <li>
                     <a href="/dashboard/admin/ketentuan" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/ketentuan') ? 'bg-graydark text-white' : 'text-gray-500' }}">Ketentuan</a>
                  </li>
                  <li>
                     <a href="/dashboard/admin/pelanggaran" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/pelanggaran') ? 'bg-graydark text-white' : 'text-gray-500' }}">Data Pelanggaran</a>
                  </li>
                  <li>
                     <a href="/dashboard/admin/hasil" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/hasil') ? 'bg-graydark text-white' : 'text-gray-500' }}">Hasil</a>
                  </li>
            </ul>
          </li>        
          <li class="border-t">
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-500 transition duration-75 rounded-lg group hover:bg-graydark dark:hover:bg-meta-4 hover:text-white" aria-controls="dropdown-presences" data-collapse-toggle="dropdown-presences">
               <svg class="w-6 h-6 text-gray-500 group-hover:text-white" aria-hidden="true" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.5 8C5.80777 8 5.13108 7.79473 4.55551 7.41015C3.97993 7.02556 3.53133 6.47893 3.26642 5.83939C3.00152 5.19985 2.9322 4.49612 3.06725 3.81719C3.2023 3.13825 3.53564 2.51461 4.02513 2.02513C4.51461 1.53564 5.13825 1.2023 5.81719 1.06725C6.49612 0.932205 7.19985 1.00152 7.83939 1.26642C8.47893 1.53133 9.02556 1.97993 9.41015 2.55551C9.79473 3.13108 10 3.80777 10 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M6.5 17H1V15C1 13.9391 1.42143 12.9217 2.17157 12.1716C2.92172 11.4214 3.93913 11 5 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M19.5 11H18.38C18.2672 10.5081 18.0714 10.0391 17.801 9.613L18.601 8.818C18.6947 8.72424 18.7474 8.59708 18.7474 8.4645C18.7474 8.33192 18.6947 8.20476 18.601 8.111L17.894 7.404C17.8002 7.31026 17.6731 7.25761 17.5405 7.25761C17.4079 7.25761 17.2808 7.31026 17.187 7.404L16.392 8.204C15.9647 7.93136 15.4939 7.73384 15 7.62V6.5C15 6.36739 14.9473 6.24021 14.8536 6.14645C14.7598 6.05268 14.6326 6 14.5 6H13.5C13.3674 6 13.2402 6.05268 13.1464 6.14645C13.0527 6.24021 13 6.36739 13 6.5V7.62C12.5081 7.73283 12.0391 7.92863 11.613 8.199L10.818 7.404C10.7242 7.31026 10.5971 7.25761 10.4645 7.25761C10.3319 7.25761 10.2048 7.31026 10.111 7.404L9.404 8.111C9.31026 8.20476 9.25761 8.33192 9.25761 8.4645C9.25761 8.59708 9.31026 8.72424 9.404 8.818L10.204 9.618C9.9324 10.0422 9.73492 10.5096 9.62 11H8.5C8.36739 11 8.24021 11.0527 8.14645 11.1464C8.05268 11.2402 8 11.3674 8 11.5V12.5C8 12.6326 8.05268 12.7598 8.14645 12.8536C8.24021 12.9473 8.36739 13 8.5 13H9.62C9.73283 13.4919 9.92863 13.9609 10.199 14.387L9.404 15.182C9.31026 15.2758 9.25761 15.4029 9.25761 15.5355C9.25761 15.6681 9.31026 15.7952 9.404 15.889L10.111 16.596C10.2048 16.6897 10.3319 16.7424 10.4645 16.7424C10.5971 16.7424 10.7242 16.6897 10.818 16.596L11.618 15.796C12.0422 16.0676 12.5096 16.2651 13 16.38V17.5C13 17.6326 13.0527 17.7598 13.1464 17.8536C13.2402 17.9473 13.3674 18 13.5 18H14.5C14.6326 18 14.7598 17.9473 14.8536 17.8536C14.9473 17.7598 15 17.6326 15 17.5V16.38C15.4919 16.2672 15.9609 16.0714 16.387 15.801L17.182 16.601C17.2758 16.6947 17.4029 16.7474 17.5355 16.7474C17.6681 16.7474 17.7952 16.6947 17.889 16.601L18.596 15.894C18.6897 15.8002 18.7424 15.6731 18.7424 15.5405C18.7424 15.4079 18.6897 15.2808 18.596 15.187L17.796 14.392C18.0686 13.9647 18.2662 13.4939 18.38 13H19.5C19.6326 13 19.7598 12.9473 19.8536 12.8536C19.9473 12.7598 20 12.6326 20 12.5V11.5C20 11.3674 19.9473 11.2402 19.8536 11.1464C19.7598 11.0527 19.6326 11 19.5 11ZM14 14.5C13.5055 14.5 13.0222 14.3534 12.6111 14.0787C12.2 13.804 11.8795 13.4135 11.6903 12.9567C11.5011 12.4999 11.4516 11.9972 11.548 11.5123C11.6445 11.0273 11.8826 10.5819 12.2322 10.2322C12.5819 9.8826 13.0273 9.6445 13.5123 9.54804C13.9972 9.45157 14.4999 9.50108 14.9567 9.6903C15.4135 9.87952 15.804 10.2 16.0787 10.6111C16.3534 11.0222 16.5 11.5055 16.5 12C16.5 12.663 16.2366 13.2989 15.7678 13.7678C15.2989 14.2366 14.663 14.5 14 14.5Z" fill="currentColor"/>
               </svg>              
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Panel Presensi</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-presences" class="hidden py-2 space-y-2">
                  <li>
                     <a href="/dashboard/admin/kehadiran" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/kehadiran') ? 'bg-graydark text-white' : 'text-gray-500' }}">Presensi</a>
                  </li>
                  <li>
                     <a href="/dashboard/admin/presensi" class="flex items-center w-full p-2 text-gray-500 hover:text-white transition duration-75 rounded-lg pl-11 group hover:bg-graydark dark:hover:bg-meta-4 {{ request()->is('dashboard/admin/presensi') ? 'bg-graydark text-white' : 'text-gray-500' }}">Data Kehadiran</a>
                  </li>
            </ul>
          </li>        
         @endif        
       </ul>
      </div>
    </nav>
    <!-- Sidebar Menu -->
  </div>
</aside>
