<?php if (isset($component)) { $__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.public-layout','data' => ['title' => $post->title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('public-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->title)]); ?>
    <article class="py-12 sm:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-8" aria-label="Breadcrumb">
                <a href="<?php echo e(route('posts.index')); ?>" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Articles</a>
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="<?php echo e(route('posts.index', ['category' => $post->category->slug])); ?>" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <?php echo e($post->category->name); ?>

                </a>
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-700 dark:text-gray-300 truncate max-w-[200px]"><?php echo e($post->title); ?></span>
            </nav>

            <!-- Category & Reading Time Meta -->
            <div class="flex items-center gap-3 mb-4">
                <a href="<?php echo e(route('posts.index', ['category' => $post->category->slug])); ?>">
                    <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => $post->category->color,'size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->category->color),'size' => 'lg']); ?>
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
                <span class="text-xs text-gray-400">&bull;</span>
                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <?php echo e(max(1, (int) ceil(str_word_count(strip_tags($post->body)) / 200))); ?> min read
                </span>
            </div>

            <!-- Single Post Title -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight leading-[1.2]">
                <?php echo e($post->title); ?>

            </h1>

            <!-- Author & Publish Date Bar -->
            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3.5">
                    <a href="<?php echo e(route('posts.index', ['author' => $post->author->username])); ?>">
                        <img src="<?php echo e($post->author->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $post->author->username); ?>"
                             alt="<?php echo e($post->author->name); ?>"
                             class="w-11 h-11 rounded-full border border-gray-200 dark:border-gray-700 object-cover bg-gray-50">
                    </a>
                    <div>
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('posts.index', ['author' => $post->author->username])); ?>"
                               class="text-sm font-bold text-gray-900 dark:text-gray-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                <?php echo e($post->author->name); ?>

                            </a>
                            <span class="text-xs text-indigo-600 dark:text-indigo-400 font-mono">@<span><?php echo e($post->author->username); ?></span></span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Published on <?php echo e($post->created_at->format('F d, Y')); ?> (<?php echo e($post->created_at->diffForHumans()); ?>)
                        </p>
                    </div>
                </div>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $post)): ?>
                    <div class="flex items-center gap-2">
                        <a href="<?php echo e(route('dashboard.posts.edit', $post)); ?>"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Article
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Featured Image or Art Banner -->
            <div class="mt-8 rounded-3xl overflow-hidden border border-gray-200/80 dark:border-gray-800/80 shadow-sm bg-gray-100 dark:bg-gray-900">
                <?php if($post->image): ?>
                    <img src="<?php echo e(asset('storage/' . $post->image)); ?>"
                         alt="<?php echo e($post->title); ?>"
                         class="w-full max-h-[460px] object-cover">
                <?php else: ?>
                    <div class="h-64 sm:h-80 w-full bg-gradient-to-tr from-indigo-500/20 via-purple-500/20 to-pink-500/10 flex items-center justify-center relative overflow-hidden">
                        <div class="text-center p-6">
                            <span class="inline-block p-4 rounded-2xl bg-white dark:bg-gray-800 shadow-xl text-indigo-600 dark:text-indigo-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Article Body Content -->
            <div class="mt-10 prose prose-lg dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed space-y-6">
                <?php echo nl2br(e($post->body)); ?>

            </div>

            <!-- Author Bio Card Box -->
            <div class="mt-16 p-8 rounded-3xl bg-white dark:bg-gray-900 border border-gray-200/80 dark:border-gray-800/80 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-6 text-center sm:text-left">
                <img src="<?php echo e($post->author->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $post->author->username); ?>"
                     alt="<?php echo e($post->author->name); ?>"
                     class="w-20 h-20 rounded-2xl border-2 border-indigo-500/20 object-cover shadow-sm">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">
                        Written by <?php echo e($post->author->name); ?>

                    </h3>
                    <p class="text-xs text-indigo-600 dark:text-indigo-400 font-mono mt-0.5">
                        @<span><?php echo e($post->author->username); ?></span>
                    </p>
                    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        Contributing author on DevSphere, sharing deep-dives on full-stack architecture, clean code standards, and developer productivity.
                    </p>
                    <div class="mt-4">
                        <a href="<?php echo e(route('posts.index', ['author' => $post->author->username])); ?>"
                           class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300">
                            View all articles by <?php echo e($post->author->name); ?> &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <?php if(isset($relatedPosts) && $relatedPosts->count() > 0): ?>
                <div class="mt-20 pt-12 border-t border-gray-200/80 dark:border-gray-800/80">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">
                        More in <span class="text-indigo-600 dark:text-indigo-400"><?php echo e($post->category->name); ?></span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal14b498b52c33a1421ff8895e4557790f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal14b498b52c33a1421ff8895e4557790f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.post-card','data' => ['post' => $related]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('post-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['post' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($related)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal14b498b52c33a1421ff8895e4557790f)): ?>
<?php $attributes = $__attributesOriginal14b498b52c33a1421ff8895e4557790f; ?>
<?php unset($__attributesOriginal14b498b52c33a1421ff8895e4557790f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal14b498b52c33a1421ff8895e4557790f)): ?>
<?php $component = $__componentOriginal14b498b52c33a1421ff8895e4557790f; ?>
<?php unset($__componentOriginal14b498b52c33a1421ff8895e4557790f); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Back to All Posts Button -->
            <div class="mt-12 text-center">
                <a href="<?php echo e(route('posts.index')); ?>"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/60 shadow-sm transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to All Articles
                </a>
            </div>

        </div>
    </article>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b)): ?>
<?php $attributes = $__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b; ?>
<?php unset($__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b)): ?>
<?php $component = $__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b; ?>
<?php unset($__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/posts/show.blade.php ENDPATH**/ ?>