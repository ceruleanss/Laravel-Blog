<header x-data="{ mobileMenuOpen: false, userDropdownOpen: false }" class="sticky top-0 z-40 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200/80 dark:border-gray-800/80 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Brand Logo -->
            <div class="flex items-center gap-8">
                <a href="{{ route('posts.index') }}" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-500/25 group-hover:scale-105 transition-all duration-200">
                        B
                    </div>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-xl tracking-tight bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 dark:from-white dark:via-gray-100 dark:to-gray-300 bg-clip-text text-transparent">
                            Laravel Blog
                        </span>
                        <span class="text-[10px] tracking-widest uppercase font-semibold text-indigo-600 dark:text-indigo-400 -mt-1">
                            Insights &amp; Ideas
                        </span>
                    </div>
                </a>

                <!-- Desktop Primary Links -->
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('posts.index') }}"
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('posts.index') && !request('category') && !request('author') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300' : 'text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800/60' }}">
                        Explore All
                    </a>
                    <a href="{{ route('posts.index', ['category' => 'web-development']) }}"
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request('category') === 'web-development' ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300' : 'text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800/60' }}">
                        Web Dev
                    </a>
                    <a href="{{ route('posts.index', ['category' => 'artificial-intelligence']) }}"
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request('category') === 'artificial-intelligence' ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300' : 'text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800/60' }}">
                        AI &amp; ML
                    </a>
                </nav>
            </div>

            <!-- Right Actions (Auth / Guest) -->
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <!-- Author Dashboard Direct Link -->
                    <a href="{{ route('dashboard.posts.create') }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-semibold bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm shadow-indigo-500/20 hover:shadow-indigo-500/30 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Write Post
                    </a>

                    <!-- User Profile Dropdown with Alpine.js -->
                    <div class="relative" @click.outside="userDropdownOpen = false">
                        <button @click="userDropdownOpen = !userDropdownOpen"
                                type="button"
                                class="flex items-center gap-2 p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <img src="{{ auth()->user()->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . auth()->user()->username }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-8 h-8 rounded-full border border-gray-200 dark:border-gray-700 object-cover bg-white">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 max-w-[120px] truncate">
                                {{ auth()->user()->name }}
                            </span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': userDropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Alpine.js Dropdown Menu with Transition -->
                        <div x-show="userDropdownOpen"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 transform scale-95 -translate-y-1"
                             x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 transform scale-95 -translate-y-1"
                             style="display: none;"
                             class="absolute right-0 mt-2 w-56 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl py-1 z-50">
                            
                            <div class="px-4 py-2.5 border-b border-gray-100 dark:border-gray-700/60">
                                <p class="text-xs font-medium text-gray-400 dark:text-gray-500">Signed in as</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->email }}</p>
                                <p class="text-xs text-indigo-600 dark:text-indigo-400 font-mono">@<span>{{ auth()->user()->username }}</span></p>
                            </div>

                            <div class="py-1">
                                <a href="{{ route('dashboard.posts.index') }}"
                                   class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                    </svg>
                                    My Articles
                                </a>

                                <a href="{{ route('posts.index', ['author' => auth()->user()->username]) }}"
                                   class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Public Profile Feed
                                </a>

                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Account Settings
                                </a>
                            </div>

                            <div class="border-t border-gray-100 dark:border-gray-700/60 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left flex items-center gap-2.5 px-4 py-2 text-sm text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm shadow-indigo-500/25 transition-all">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger Toggle -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        type="button"
                        class="p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" :class="{ 'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="w-6 h-6" :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Alpine.js Mobile Menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             style="display: none;"
             class="md:hidden border-t border-gray-200 dark:border-gray-800 py-3 space-y-1">
            
            <a href="{{ route('posts.index') }}"
               class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                Explore All
            </a>
            <a href="{{ route('posts.index', ['category' => 'web-development']) }}"
               class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                Web Development
            </a>
            <a href="{{ route('posts.index', ['category' => 'artificial-intelligence']) }}"
               class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                Artificial Intelligence
            </a>

            <div class="pt-3 border-t border-gray-200 dark:border-gray-800 space-y-2">
                @auth
                    <div class="px-3 py-2 flex items-center gap-3">
                        <img src="{{ auth()->user()->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . auth()->user()->username }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-9 h-9 rounded-full border border-gray-200 dark:border-gray-700 object-cover">
                        <div>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-indigo-600 dark:text-indigo-400">@<span>{{ auth()->user()->username }}</span></p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.posts.create') }}"
                       class="block px-3 py-2 rounded-lg text-base font-medium text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/40">
                        + Write New Post
                    </a>
                    <a href="{{ route('dashboard.posts.index') }}"
                       class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                        Author Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-3 py-2 rounded-lg text-base font-medium text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40">
                            Sign Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                       class="block text-center px-3 py-2.5 rounded-lg text-base font-semibold bg-indigo-600 text-white hover:bg-indigo-700">
                        Create Account
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
