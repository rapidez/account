@props(['href', 'text', 'icon'])
<a
    class="{{ request()->is(trim($href, '/')) ? 'text-accent bg-accent/10' : 'text-secondary hover:text-primary' }} flex w-full items-center gap-2 rounded p-2 font-medium transition hover:bg-accent/20"
    href="{{ $href }}"
>
    <x-icon
        class="h-5 w-5"
        name="{{ $icon ?? 'heroicon-o-cog' }}"
    />
    {{ $text }}
</a>
