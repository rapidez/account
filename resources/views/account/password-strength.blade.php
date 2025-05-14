<password-strength
    v-slot="passwordStrength"
    v-bind:classes='@json($classes)'
    v-bind:extra-checks='@json($extraChecks)'
    v-bind:min-classes="{{ Rapidez::config('customer/password/required_character_classes_number') }}"
    {{ $attributes }}
>
    <div>
        <p v-if="passwordStrength.minClasses < 4" class="text-inactive mb-2 text-xs">
            @lang('Password must have at least :minClasses different types of characters', ['minClasses' => '@{{ passwordStrength.minClasses }}'])
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
                    v-bind:oninvalid="`this.setCustomValidity('${error}')`"
                    tabindex="-1"
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
