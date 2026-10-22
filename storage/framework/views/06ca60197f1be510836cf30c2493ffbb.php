<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'color' => 'blue',
    'size' => 'md',
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
    'color' => 'blue',
    'size' => 'md',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $colorClasses = match ($color) {
        'purple' => 'bg-purple-50 text-purple-700 border-purple-200/80 hover:bg-purple-100 dark:bg-purple-950/50 dark:text-purple-300 dark:border-purple-800/60',
        'emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80 hover:bg-emerald-100 dark:bg-emerald-950/50 dark:text-emerald-300 dark:border-emerald-800/60',
        'amber' => 'bg-amber-50 text-amber-700 border-amber-200/80 hover:bg-amber-100 dark:bg-amber-950/50 dark:text-amber-300 dark:border-amber-800/60',
        'rose' => 'bg-rose-50 text-rose-700 border-rose-200/80 hover:bg-rose-100 dark:bg-rose-950/50 dark:text-rose-300 dark:border-rose-800/60',
        'red' => 'bg-red-50 text-red-700 border-red-200/80 hover:bg-red-100 dark:bg-red-950/50 dark:text-red-300 dark:border-red-800/60',
        'green' => 'bg-green-50 text-green-700 border-green-200/80 hover:bg-green-100 dark:bg-green-950/50 dark:text-green-300 dark:border-green-800/60',
        'indigo' => 'bg-indigo-50 text-indigo-700 border-indigo-200/80 hover:bg-indigo-100 dark:bg-indigo-950/50 dark:text-indigo-300 dark:border-indigo-800/60',
        default => 'bg-blue-50 text-blue-700 border-blue-200/80 hover:bg-blue-100 dark:bg-blue-950/50 dark:text-blue-300 dark:border-blue-800/60',
    };

    $sizeClasses = match ($size) {
        'sm' => 'text-[11px] px-2 py-0.5',
        'lg' => 'text-sm px-3.5 py-1',
        default => 'text-xs px-2.5 py-1',
    };
?>

<span <?php echo e($attributes->merge(['class' => "inline-flex items-center font-medium rounded-full border transition-colors {$colorClasses} {$sizeClasses}"])); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH /var/www/html/resources/views/components/badge.blade.php ENDPATH**/ ?>