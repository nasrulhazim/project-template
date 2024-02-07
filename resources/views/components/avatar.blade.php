@props(['name' => 'A'])
@php
    $name = trim(
        collect(explode(' ', $name))
            ->map(function ($segment) {
                return mb_substr($segment, 0, 1);
            })
            ->join(' '),
    );
@endphp

<div alt="{{ auth()->user()->name }}"
    {{ $attributes->merge([
        'class' => 'bg-indigo-300 flex h-20 items-center justify-center object-cover rounded-full text-4xl text-white w-20',
    ]) }}>
    {{ $name }}
</div>
