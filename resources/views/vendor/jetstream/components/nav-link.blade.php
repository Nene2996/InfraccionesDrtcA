@props(['active'])

@php
$classes = ($active ?? false)
            ? 'hover:bg-trueGray-400 hover:text-black px-4 py-2 rounded-md bg-trueGray-400 text-black'
            : 'hover:bg-trueGray-400 hover:text-black px-4 py-2 rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
