<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | DyWix Studio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased overflow-hidden" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-slate-900/50 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" x-cloak></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-72 bg-slate-900 transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto flex flex-col h-screen border-r border-slate-800 shadow-2xl lg:shadow-none">
            
            <!-- Logo area -->
            <div class="flex items-center justify-between h-20 border-b border-slate-800 px-6 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="text-white text-2xl font-bold tracking-tight inline-flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    DyWix <span class="text-indigo-400 font-light">Admin</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white focus:outline-none transition-colors ml-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto w-full">
                <!-- Dashboard Link -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 border-transparent' }} rounded-xl border transition-all group font-medium text-sm">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <!-- Our Work Link -->
                <a href="{{ route('admin.dashboard.our-work.index') }}"
                   class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard.our-work.*') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 border-transparent' }} rounded-xl border transition-all group font-medium text-sm">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard.our-work.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h8M4 3h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
                    </svg>
                    Our Work
                </a>

                <!-- Admin Users Link -->
                @if(Route::has('admin.users.index'))
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 border-transparent' }} rounded-xl border transition-all group font-medium text-sm">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Admin Users
                </a>
                @endif

                <!-- Landing Pages -->
                <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">SEO Optimization</div>

                <a href="{{ route('admin.pages.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.pages.*') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 border-transparent' }} rounded-xl border transition-all group font-medium text-sm">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.pages.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Landing Pages
                </a>

                <!-- Blog Management Header -->
                <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Blog System</div>

                <!-- Categories Link -->
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 border-transparent' }} rounded-xl border transition-all group font-medium text-sm">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.categories.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Categories
                </a>

                <!-- Posts Link -->
                <a href="{{ route('admin.posts.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.posts.*') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 border-transparent' }} rounded-xl border transition-all group font-medium text-sm">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.posts.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9a2 2 0 00-2 2v2M4 7h16"></path></svg>
                    Articles
                </a>
            </nav>

            <!-- Bottom profile area in sidebar -->
            <div class="border-t border-slate-800 p-4 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-300 font-bold uppercase overflow-hidden shrink-0">
                        {{ substr(auth('admin')->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex flex-col overflow-hidden min-w-0">
                        <span class="text-sm font-semibold text-white truncate">{{ auth('admin')->user()->name }}</span>
                        <span class="text-xs text-slate-500 truncate">{{ auth('admin')->user()->email }}</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
            
            <!-- Top Header -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 shrink-0 z-10 shadow-sm relative">
                
                <!-- Mobile toggle button -->
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-700 focus:outline-none p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Page Title Area (Left) -->
                <div class="hidden lg:flex flex-col">
                    <h1 class="text-xl font-bold text-slate-800 tracking-tight">@yield('page_title', 'Overview')</h1>
                    <div class="text-xs text-slate-500 font-medium tracking-wide">@yield('page_subtitle', 'Manage your application')</div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-2 sm:gap-4 ml-auto">
                    
                    <!-- Notification Bell -->
                    <button class="relative p-2 text-slate-400 hover:text-indigo-500 transition-colors rounded-full hover:bg-indigo-50">
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-pink-500 rounded-full border-2 border-white"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>

                    <div class="h-8 w-px bg-slate-200 mx-1 sm:mx-2"></div>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ userMenuOpen: false }" @click.away="userMenuOpen = false">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center gap-2 hover:bg-slate-50 p-2 rounded-xl transition-colors">
                            <div class="text-right hidden sm:block">
                                <div class="text-sm font-bold text-slate-800">{{ auth('admin')->user()->name }}</div>
                                <div class="text-xs text-slate-500 font-medium">Administrator</div>
                            </div>
                            <div class="w-9 h-9 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold uppercase shrink-0">
                                {{ substr(auth('admin')->user()->name ?? 'A', 0, 1) }}
                            </div>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="userMenuOpen" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-xl py-2 z-50 float-right" x-cloak>
                            <a href="#" class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors">Profile Settings</a>
                            <div class="my-1 border-t border-slate-100"></div>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <!-- Session messages -->
                @if (session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-xl shadow-sm flex items-center gap-3" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                        <button @click="show = false" class="ml-auto text-emerald-600 hover:text-emerald-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif
                
                <div class="mx-auto max-w-7xl">
                    <!-- Mobile page title -->
                    <div class="mb-6 lg:hidden">
                        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">@yield('page_title', 'Overview')</h1>
                        <div class="text-sm text-slate-500 font-medium tracking-wide">@yield('page_subtitle', 'Manage your application')</div>
                    </div>

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
