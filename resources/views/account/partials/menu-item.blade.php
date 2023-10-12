@props(['href', 'text', 'icon'])
<a
    href="{{ $href }}"
    @class([
        'flex items-center gap-2 rounded p-2 font-medium transition hover:bg-primary/20',
        'text-primary bg-primary/10' => request()->url() == $href,
        'text-inactive hover:text-neutral' => !request()->url() == $href,
    ])
>
    <x-icon class="h-5 w-5" name="{{ $icon ?? 'heroicon-o-cog' }}" />
    {{ $text }}
</a>
