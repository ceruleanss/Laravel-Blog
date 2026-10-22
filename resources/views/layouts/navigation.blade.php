<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('posts.index') }}" class="flex items-center gap-2 group">
                        <span class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white font-black text-lg shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                            B
                        </span>
                        <span class="font-extrabold text-lg text-gray-900 dark:text-white">
                            Laravel Blog
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard.posts.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-semibold leading-5 transition duration-150 ease-in-out {{ request()->routeIs('dashboard.posts.*') ? 'border-indigo-600 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:border-gray-300' }}">
                        My Articles
                    </a>
                    <a href="{{ route('posts.index') }}"
                       target="_blank"
                       class="inline-flex items-center gap-1 px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:border-gray-300 transition duration-150 ease-in-out">
                        Public Blog
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown with Alpine.js -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                    <button @click="dropdownOpen = !dropdownOpen"
                            class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-semibold rounded-full text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none transition ease-in-out duration-150">
                        <img src="{{ Auth::user()->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . Auth::user()->username }}"
                             alt="{{ Auth::user()->name }}"
                             class="w-8 h-8 rounded-full border border-gray-200 dark:border-gray-700 object-cover">
                        <div>{{ Auth::user()->name }}</div>
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="dropdownOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         style="display: none;"
                         class="absolute right-0 z-50 mt-2 w-48 rounded-xl shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                        <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700 text-xs text-gray-500 font-mono">
                            @<span>{{ Auth::user()->username }}</span>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Profile Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-start block px-4 py-2 text-sm text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu with Alpine.js -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200 dark:border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard.posts.index') }}"
               class="block ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('dashboard.posts.*') ? 'border-indigo-600 text-indigo-700 bg-indigo-50 dark:bg-indigo-950/50 dark:text-indigo-300 font-semibold' : 'border-transparent text-gray-600 hover:bg-gray-50' }}">
                My Articles
            </a>
            <a href="{{ route('posts.index') }}"
               class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50">
                Public Blog Feed
            </a>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-800">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                    Profile Settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-start block px-4 py-2 text-sm text-rose-600 hover:bg-rose-50">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
