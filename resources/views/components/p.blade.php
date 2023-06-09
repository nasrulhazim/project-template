@props(['value'])

<p {{ $attributes->merge(['class' => 'mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-white']) }}>
    {{ $value ?? $slot }}
</p>
