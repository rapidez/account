@slots(['label'])

@php($checks = [
        'length' => __('Bevat :length karakters', ['length' => '8']),
        'lowercase' => __('Contains a lowercase letter'),
        'uppercase' => __('Contains an uppercase letter'),
        'number' => __('Contains a number'),
        'special' => __('Contains a special character')
    ])

<div {{ $attributes->only('class')->class('') }}>
    <x-rapidez::label class="mb-2 text-inactive">
        {{ $label }}
    </x-rapidez::label>
    <password-strength
        v-slot="passwordStrength"
        v-bind:checks='@json($checks)'
        v-bind:min-length="{{ Rapidez::config('customer/password/minimum_password_length', 8) }}"
        v-bind:min-classes="{{ Rapidez::config('customer/password/required_character_classes_number', 3) }}"
        {{ $attributes }}
    >
        <div>
            <p v-if="passwordStrength.minClasses < 4" class="mb-2 text-xs text-inactive">
                @lang('Password must have :minClasses differrent characters', ['minClasses' => '@{{ passwordStrength.minClasses }}'])
            </p>
            <div class="mb-4 h-2.5 w-full rounded-full bg-gray-200">
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
                <p class="text-sm text-primary"> @{{ error }}<input
                        type="checkbox"
                        oninvalid="this.setCustomValidity(error)"
                        required
                        class="pointer-events-none absolute inset-0 opacity-0"
                    ></p>
            </div>
            <div v-for="strength in passwordStrength.strengths" class="my-1 flex items-center gap-x-2">
                <div class="flex size-4 shrink-0 items-center justify-center rounded-full text-white">
                    <x-heroicon-s-check-circle class="size-4 text-green-700" />
                </div>
                <p class="text-sm text-green-700"> @{{ strength }}</p>
            </div>
        </div>
    </password-strength>
</div>
