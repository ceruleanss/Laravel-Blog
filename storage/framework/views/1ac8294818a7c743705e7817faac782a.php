<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['post']));

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

foreach (array_filter((['post']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<article class="flex flex-col bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/80 dark:border-gray-800/80 overflow-hidden hover:border-indigo-300 dark:hover:border-indigo-700/60 hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 group">
    <!-- Featured Image or Modern Geometric Banner Container -->
    <div class="relative h-48 sm:h-52 overflow-hidden bg-gray-100 dark:bg-gray-800">
        <a href="<?php echo e(route('posts.show', $post)); ?>" class="block w-full h-full" aria-label="<?php echo e($post->title); ?>">
            <?php if($post->image): ?>
                <img src="<?php echo e(asset('storage/' . $post->image)); ?>"
                     alt="<?php echo e($post->title); ?>"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <?php else: ?>
                <!-- Elegant Fallback Gradient Art with subtle SVG grid -->
                <div class="w-full h-full bg-gradient-to-br from-indigo-500/10 via-purple-500/10 to-pink-500/10 dark:from-indigo-900/20 dark:via-purple-900/20 dark:to-pink-900/20 flex items-center justify-center relative overflow-hidden">
                    <svg class="absolute inset-0 w-full h-full opacity-30 dark:opacity-20" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <defs>
                            <pattern id="grid-<?php echo e($post->id); ?>" width="24" height="24" patternUnits="userSpaceOnUse">
                                <path d="M 24 0 L 0 0 0 24" fill="none" stroke="currentColor" stroke-width="0.5" class="text-indigo-400 dark:text-indigo-500" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid-<?php echo e($post->id); ?>)" />
                    </svg>
                    <div class="z-10 text-center p-4">
                        <span class="inline-block p-3 rounded-2xl bg-white dark:bg-gray-800 shadow-md border border-gray-200/50 dark:border-gray-700/50 text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </a>

        <!-- Floating Category Badge on top of image (sibling of image anchor) -->
        <div class="absolute top-3.5 left-3.5 z-10">
            <a href="<?php echo e(route('posts.index', ['category' => $post->category->slug])); ?>"
               class="inline-block">
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => $post->category->color]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->category->color)]); ?>
                    <?php echo e($post->category->name); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
            </a>
        </div>
    </div>

    <!-- Card Body Content -->
    <div class="flex-1 p-6 flex flex-col justify-between">
        <div>
            <!-- Post Title -->
            <h2 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors leading-snug">
                <a href="<?php echo e(route('posts.show', $post)); ?>">
                    <?php echo e($post->title); ?>

                </a>
            </h2>

            <!-- Excerpt -->
            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 line-clamp-3 leading-relaxed">
                <?php echo e(\Illuminate\Support\Str::limit(strip_tags($post->body), 130)); ?>

            </p>
        </div>

        <!-- Author Metadata & Read Link -->
        <div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
            <a href="<?php echo e(route('posts.index', ['author' => $post->author->username])); ?>"
               class="flex items-center gap-2.5 group/author">
                <img src="<?php echo e($post->author->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $post->author->username); ?>"
                     alt="<?php echo e($post->author->name); ?>"
                     class="w-8 h-8 rounded-full border border-gray-200 dark:border-gray-700 object-cover bg-gray-50">
                <div class="flex flex-col">
                    <span class="text-xs font-semibold text-gray-900 dark:text-gray-200 group-hover/author:text-indigo-600 dark:group-hover/author:text-indigo-400 transition-colors">
                        <?php echo e($post->author->name); ?>

                    </span>
                    <time datetime="<?php echo e($post->created_at->toIso8601String()); ?>" class="text-[11px] text-gray-400 dark:text-gray-500">
                        <?php echo e($post->created_at->diffForHumans()); ?>

                    </time>
                </div>
            </a>

            <a href="<?php echo e(route('posts.show', $post)); ?>"
               class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 group-hover:translate-x-0.5 transition-transform">
                Read
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</article>
<?php /**PATH /var/www/html/resources/views/components/post-card.blade.php ENDPATH**/ ?>