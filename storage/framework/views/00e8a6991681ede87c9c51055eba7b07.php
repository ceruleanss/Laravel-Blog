<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'placeholder' => 'Search articles by keyword or topic...',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'placeholder' => 'Search articles by keyword or topic...',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<form method="GET" action="<?php echo e(route('posts.index')); ?>" class="w-full">
    <!-- Preserve active category filter if present -->
    <?php if(request('category')): ?>
        <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
    <?php endif; ?>

    <!-- Preserve active author filter if present -->
    <?php if(request('author')): ?>
        <input type="hidden" name="author" value="<?php echo e(request('author')); ?>">
    <?php endif; ?>

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
               value="<?php echo e(request('search')); ?>"
               placeholder="<?php echo e($placeholder); ?>"
               class="w-full pl-11 pr-24 py-3 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-all">

        <!-- Action Buttons (Clear & Submit) -->
        <div class="absolute inset-y-0 right-0 pr-2 flex items-center gap-1.5">
            <?php if(request('search')): ?>
                <a href="<?php echo e(route('posts.index', request()->except('search'))); ?>"
                   title="Clear search"
                   class="p-1.5 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            <?php endif; ?>

            <button type="submit"
                    class="px-3.5 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition-colors">
                Search
            </button>
        </div>
    </div>
</form>
<?php /**PATH /var/www/html/resources/views/components/search-bar.blade.php ENDPATH**/ ?>