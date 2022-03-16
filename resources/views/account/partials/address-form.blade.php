<form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate">
    <div class="flex space-x-4">
        <div class="w-1/2">
            <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Contact information')</h2>
            <div class="flex flex-col space-y-3">
                <x-rapidez::input name="firstname" v-model="variables.firstname" required />
                <x-rapidez::input name="lastname" v-model="variables.lastname" required />
                <x-rapidez::input name="company" v-model="variables.company" />
                <x-rapidez::input name="telephone" v-model="variables.telephone" required />
            </div>
        </div>

        <div class="w-1/2">
            <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Address')</h2>
            <div class="flex flex-col space-y-3">
                <x-rapidez::input name="street[0]" v-model="variables.street[0]" label="Street" placeholder="Street" required />
                <x-rapidez::input name="street[1]" v-model="variables.street[1]" label="" placeholder="" />
                <x-rapidez::input name="street[2]" v-model="variables.street[2]" label="" placeholder="" />

                <x-rapidez::country-select
                    name="country_code"
                    label="Country"
                    v-model="variables.country_code"
                    class="w-full"
                    required
                />

                <x-rapidez::input name="city" v-model="variables.city" required />
                <x-rapidez::input name="postcode" v-model="variables.postcode" required />
            </div>
        </div>
    </div>

    <x-rapidez::checkbox v-model="variables.default_billing">@lang('Default billing address')</x-rapidez::checkbox>
    <x-rapidez::checkbox v-model="variables.default_shipping">@lang('Default shipping address')</x-rapidez::checkbox>

    <div class="flex items-center mt-5">
        <x-rapidez::button type="submit">
            @lang(request()->id ? 'Change' : 'Add')
        </x-rapidez::button>

        <div v-if="mutated" class="ml-3 text-green-500">
            @lang('Changed successfully!')
        </div>
    </div>
</form>
