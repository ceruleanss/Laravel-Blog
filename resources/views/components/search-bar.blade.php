@props([
    'placeholder' => 'Search articles by keyword or topic...',
])

<form method="GET" action="{{ route('posts.index') }}" class="w-full">
    <!-- Preserve active category filter if present -->
    @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif

    <!-- Preserve active author filter if present -->
    @if(request('author'))
        <input type="hidden" name="author" value="{{ request('author') }}">
    @endif

    <div class="relative flex items-center">
        <!-- Search Icon -->
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        <!-- Search Input -->
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="{{ $placeholder }}"
               class="w-full pl-11 pr-24 py-3 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-all">

        <!-- Action Buttons (Clear & Submit) -->
        <div class="absolute inset-y-0 right-0 pr-2 flex items-center gap-1.5">
            @if(request('search'))
                <a href="{{ route('posts.index', request()->except('search')) }}"
                   title="Clear search"
                   class="p-1.5 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            @endif

            <button type="submit"
                    class="px-3.5 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition-colors">
                Search
            </button>
        </div>
    </div>
</form>
