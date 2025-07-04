<aside 
    class="w-64 flex-shrink-0 bg-secondary border-r border-gray-800 flex flex-col z-40 fixed inset-y-0 left-0 transform lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out"
    :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
    @click.away="sidebarOpen = false"
>
    <div class="px-6 py-4 border-b border-gray-800">
        <a href="/" class="text-2xl font-bold text-white flex items-center gap-3">
            <i class="fas fa-cubes text-3xl text-teal-400"></i>
            <span>{{ $settings['server_name'] ?? 'Nilai Default' }}</span>
        </a>
        <span class="text-xs text-teal-400 ml-1">Admin Panel</span>
    </div>
    <nav class="mt-6 flex-1">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'nav-active' : '' }}">
            <i class="fas fa-tachometer-alt fa-fw w-6 text-center"></i><span>Dashboard</span>
        </a>
        <a href="{{ route('admin.news') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.news') ? 'nav-active' : '' }}">
            <i class="fas fa-newspaper fa-fw w-6 text-center"></i><span>Manajemen Berita</span>
        </a>
        <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.categories') ? 'nav-active' : '' }}">
            <i class="fas fa-tags fa-fw w-6 text-center"></i><span>Kategori Berita</span>
        </a>
        <a href="{{ route('admin.owners') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.owners') ? 'nav-active' : '' }}">
            <i class="fas fa-user-shield fa-fw w-6 text-center"></i><span>Manajemen Owner</span>
        </a>
    </nav>
    <div class="px-6 py-4 border-t border-gray-800">
        <a href="/" target="_blank" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-400 hover:bg-gray-800/50 hover:text-white transition rounded-md">
            <i class="fas fa-arrow-left fa-fw w-5 text-center"></i>
            <span>Kembali ke Situs</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-400 hover:bg-red-900/50 hover:text-red-300 transition rounded-md">
                <i class="fas fa-sign-out-alt fa-fw w-5 text-center"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
