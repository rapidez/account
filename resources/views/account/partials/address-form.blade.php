<form slot-scope="{ changes, mutate, mutated }" v-on:submit.prevent="mutate">
    <div class="flex space-x-4">
        <div class="w-1/2">
            <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Contact information')</h2>
            <div class="flex flex-col space-y-3">
                <x-rapidez::input name="firstname" v-model="changes.firstname" required />
                <x-rapidez::input name="lastname" v-model="changes.lastname" required />
                <x-rapidez::input name="company" v-model="changes.company" />
                <x-rapidez::input name="telephone" v-model="changes.telephone" required />
            </div>
        </div>

        <div class="w-1/2">
            <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Address')</h2>
            <div class="flex flex-col space-y-3">
                <x-rapidez::input name="street[0]" v-model="changes.street[0]" label="Street" placeholder="Street" required />
                <x-rapidez::input name="street[1]" v-model="changes.street[1]" label="" placeholder="" />
                <x-rapidez::input name="street[2]" v-model="changes.street[2]" label="" placeholder="" />

                <x-rapidez::input name="country_code" v-model="changes.country_code" label="Country" required />
                <x-rapidez::input name="city" v-model="changes.city" required />
                <x-rapidez::input name="postcode" v-model="changes.postcode" required />
            </div>
        </div>
    </div>

    <div class="flex items-center mt-5">
        <button
            type="submit"
            class="btn btn-primary"
            :disabled="$root.loading"
        >
            @lang(request()->id ? 'Change' : 'Add')
        </button>

        <div v-if="mutated" class="ml-3 text-green-500">
            @lang('Changed successfully!')
        </div>
    </div>
</form>
