<x-rapidez::tag
    is="{{ $tag ?? ($attributes->has('href') || $attributes->has('v-bind:href') ? 'a' : 'div') }}"
    {{ $attributes->twMerge('bg-white flex gap-y-2 gap-x-6 rounded border px-7 py-4 text-left hover:opacity-80 max-sm:flex-col sm:items-center') }}
>
    {{ $slot }}
</x-rapidez::tag>