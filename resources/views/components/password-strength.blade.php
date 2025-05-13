@slots(['label'])

@php
    $length = Rapidez::config('customer/password/minimum_password_length', 8);
    $checks = [
        'length' => [
            'text' => __('Contains :length chracters', ['length' => $length]),
            'regex' => '^.{' . $length . ',}',
        ],
        'lowercase' => [
            'text' => __('Contains a lowercase letter'),
            'regex' => '[a-z]',
        ],
        'uppercase' => [
            'text' => __('Contains an uppercase letter'),
            'regex' => '[A-Z]',
        ],
        'number' => [
            'text' => __('Contains a number'),
            'regex' => '[\d]',
        ],
        'special' => [
            'text' => __('Contains a special character'),
            'regex' => '[^a-zA-Z0-9]',
        ],
    ];
@endphp

<x-rapidez::label class="text-muted mb-2">
    {{ $label }}
</x-rapidez::label>
<password-strength
    v-slot="passwordStrength"
    v-bind:checks='@json($checks)'
    v-bind:min-classes="{{ Rapidez::config('customer/password/required_character_classes_number', 3) }}"
    {{ $attributes }}
>
    <div>
        <p v-if="passwordStrength.minClasses < 4" class="text-inactive mb-2 text-xs">
            @lang('Password must have :minClasses differrent characters', ['minClasses' => '@{{ passwordStrength.minClasses }}'])
        </p>
        <div class="mb-4 h-2.5 w-full rounded-full bg-emphasis">
            <div
                v-bind:style="`width:${passwordStrength.strengths.length / 5 * 100}%`"
                v-bind:class="passwordStrength.errors.length > 0 ? 'bg-red-500' : 'bg-green-700 !w-full'"
                class="h-2.5 rounded-full transition-all duration-300"
            ></div>
        </div>
        <div v-for="error in passwordStrength.errors" class="my-1 flex items-center gap-x-2">
            <div class="flex size-4 shrink-0 items-center justify-center rounded-full">
                <x-heroicon-s-x-circle class="size-4 text-red-500" />
            </div>
            <p class="text-primary text-sm relative">
                @{{ error }}
                <input
                    class="pointer-events-none absolute inset-0 opacity-0"
                    type="checkbox"
                    required
                >
            </p>
        </div>
        <div v-for="strength in passwordStrength.strengths" class="my-1 flex items-center gap-x-2">
            <div class="flex size-4 shrink-0 items-center justify-center rounded-full text-white">
                <x-heroicon-s-check-circle class="size-4 text-green-700" />
            </div>
            <p class="text-sm text-green-700">@{{ strength }}</p>
        </div>
    </div>
</password-strength>
