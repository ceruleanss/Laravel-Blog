@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' — ' . config('app.name', 'Blog System') : config('app.name', 'Blog System') }}</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">

    <!-- Tailwind & Alpine Assets via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">

    <!-- Top Public Navbar Component -->
    <x-navbar />

    <!-- Main Content Slot -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Public Footer Component -->
    <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-20 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Col 1: Brand Info -->
                <div class="md:col-span-2">
                    <a href="{{ route('posts.index') }}" class="flex items-center gap-2 group">
                        <span class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white font-black text-lg shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                            B
                        </span>
                        <span class="font-extrabold text-xl tracking-tight bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 dark:from-white dark:via-gray-100 dark:to-gray-300 bg-clip-text text-transparent">
                            DevSphere
                        </span>
                    </a>
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400 max-w-sm leading-relaxed">
                        A modern component-driven engineering blog built with Laravel 13, Tailwind CSS, Alpine.js, and SQLite.
                    </p>
                </div>

                <!-- Col 2: Navigation -->
                <div>
                    <h3 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Explore</h3>
                    <ul class="mt-4 space-y-2.5">
                        <li>
                            <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                All Articles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posts.index', ['category' => 'web-development']) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                Web Development
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posts.index', ['category' => 'artificial-intelligence']) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                Artificial Intelligence
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Authors & Account -->
                <div>
                    <h3 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Authors</h3>
                    <ul class="mt-4 space-y-2.5">
                        @auth
                            <li>
                                <a href="{{ route('dashboard.posts.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    Author Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard.posts.create') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    Write an Article
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    Author Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    Become an Author
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} DevSphere. Designed with Laravel Blade Components & Alpine.js.</p>
                <div class="flex items-center gap-4 mt-4 sm:mt-0">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        SQLite &amp; PHP 8.2+
                    </span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
