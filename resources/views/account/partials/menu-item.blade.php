@props(['href', 'text', 'icon'])
<a
    class="{{ request()->is(trim($href, '/')) ? 'text-primary bg-primary/10' : 'text-inactive hover:text-neutral' }} flex w-full items-center gap-2 rounded p-2 font-medium transition hover:bg-primary/20"
    href="{{ $href }}"
>
    <x-icon
        class="h-5 w-5"
        name="{{ $icon ?? 'heroicon-o-cog' }}"
    />
    {{ $text }}
</a>
