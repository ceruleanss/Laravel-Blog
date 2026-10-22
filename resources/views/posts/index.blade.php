<x-public-layout :title="'Explore Engineering & Design Insights'">
    <!-- Hero & Search Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-b from-indigo-50/70 via-white to-gray-50 dark:from-indigo-950/30 dark:via-gray-900 dark:to-gray-950 border-b border-gray-200/80 dark:border-gray-800/80 py-16 sm:py-20 transition-colors">
        <!-- Background subtle glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-64 bg-gradient-to-tr from-indigo-500/10 via-purple-500/10 to-transparent blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <!-- Top pill badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200/80 dark:border-indigo-800/60 text-indigo-700 dark:text-indigo-300 text-xs font-semibold mb-6">
                    <span class="w-2 h-2 rounded-full bg-indigo-600 dark:bg-indigo-400"></span>
                    Modern Component-Driven Publishing
                </div>

                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-[1.15]">
                    Insights, Ideas &amp; Modern <span class="bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">Engineering</span>
                </h1>

                <p class="mt-4 text-base sm:text-lg text-gray-600 dark:text-gray-300 leading-relaxed max-w-2xl mx-auto">
                    Explore curated perspectives on modern full-stack web architecture, reactive client interfaces, and backend systems.
                </p>

                <!-- Search Input Component -->
                <div class="mt-8 max-w-xl mx-auto">
                    <x-search-bar />
                </div>
            </div>

            <!-- Category Pills Navigation -->
            <div class="mt-12 flex items-center justify-center flex-wrap gap-2 pt-6 border-t border-gray-200/60 dark:border-gray-800/60">
                <!-- All Categories Pill -->
                <a href="{{ route('posts.index', request()->only(['search', 'author'])) }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ !request('category') ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-500/25' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600' }}">
                    All Topics
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('posts.index', array_merge(request()->only(['search', 'author']), ['category' => $category->slug])) }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request('category') === $category->slug ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-500/25' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600' }}">
                        <span>{{ $category->name }}</span>
                        <span class="text-[10px] px-1.5 py-0.2 rounded-full {{ request('category') === $category->slug ? 'bg-indigo-800/60 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400' }}">
                            {{ $category->posts_count }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Active Filters Summary Banner (if filtered) -->
    @if(request('search') || request('category') || request('author'))
        <div class="bg-indigo-50/80 dark:bg-indigo-950/40 border-b border-indigo-100 dark:border-indigo-900/60 py-3.5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between gap-3 text-sm">
                <div class="flex items-center flex-wrap gap-2 text-gray-600 dark:text-gray-300">
                    <span class="font-medium">Active filters:</span>

                    @if(request('search'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-xs font-medium text-gray-800 dark:text-gray-200">
                            Search: <strong>"{{ request('search') }}"</strong>
                        </span>
                    @endif

                    @if($currentCategory)
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-xs font-medium text-gray-800 dark:text-gray-200">
                            Category: <strong>{{ $currentCategory->name }}</strong>
                        </span>
                    @endif

                    @if($currentAuthor)
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-xs font-medium text-gray-800 dark:text-gray-200">
                            Author: <strong>@<span>{{ $currentAuthor }}</span></strong>
                        </span>
                    @endif
                </div>

                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 underline">
                    Clear all filters
                </a>
            </div>
        </div>
    @endif

    <!-- Articles Grid Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <span>Latest Articles</span>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-gray-200 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                    {{ $posts->total() }} posts
                </span>
            </h2>
        </div>

        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>

            <!-- Pagination Links (withQueryString enforced) -->
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 p-8">
                <div class="w-16 h-16 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 mx-auto flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">No articles matched your criteria</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                    Try adjusting your search keywords, clearing specific filters, or exploring all topics.
                </p>
                <div class="mt-6">
                    <a href="{{ route('posts.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm transition-colors">
                        Reset All Filters
                    </a>
                </div>
            </div>
        @endif
    </section>
</x-public-layout>
