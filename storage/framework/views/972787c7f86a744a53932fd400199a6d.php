<button <?php echo e($attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-wider hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-sm shadow-indigo-500/25'])); ?>>
    <?php echo e($slot); ?>

</button>
<?php /**PATH /var/www/html/resources/views/components/primary-button.blade.php ENDPATH**/ ?>