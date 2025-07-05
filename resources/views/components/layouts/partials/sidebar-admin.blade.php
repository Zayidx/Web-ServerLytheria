<nav class="mt-5 flex-1 px-2 bg-gray-800 space-y-1">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <i class="fas fa-home mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"></i>
        Dashboard
    </a>
    <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <i class="fas fa-tags mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"></i>
        Categories News
    </a>
    <a href="{{ route('admin.news') }}" class="{{ request()->routeIs('admin.news') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <i class="fas fa-newspaper mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"></i>
        News
    </a>
    <a href="{{ route('admin.owners') }}" class="{{ request()->routeIs('admin.owners') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <i class="fas fa-user-shield mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"></i>
        Owners
    </a>
    <a href="{{ route('admin.gamemodes') }}" class="{{ request()->routeIs('admin.gamemodes') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <i class="fas fa-gamepad mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"></i>
        Gamemodes
    </a>
    <a href="{{ route('admin.votes') }}" class="{{ request()->routeIs('admin.votes') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <i class="fas fa-vote-yea mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"></i>
        Votes
    </a>
    <a href="{{ route('admin.shops') }}" class="{{ request()->routeIs('admin.shops') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <i class="fas fa-store mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"></i>
        Shops
    </a>
</nav>
