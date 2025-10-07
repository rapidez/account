@props(['href', 'text'])
<a href="{{ $href }}" class="flex items-center justify-between rounded hover:underline">
    {{ $text }}
    <x-heroicon-o-chevron-right class="size-4" />
</a>
