@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-wider']) }}>
    {{ $value ?? $slot }}
</label>
