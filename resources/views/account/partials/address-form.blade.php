<form slot-scope="{ changes, mutate, mutated }" v-on:submit.prevent="mutate">
    <div class="flex space-x-4">
        <div class="w-1/2">
            <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Contact information')</h2>
            @include('rapidez::account.partials.input', ['name' => 'firstname', 'required' => true])
            @include('rapidez::account.partials.input', ['name' => 'lastname', 'required' => true])
            @include('rapidez::account.partials.input', ['name' => 'company'])
            @include('rapidez::account.partials.input', ['name' => 'telephone', 'required' => true])
        </div>

        <div class="w-1/2">
            <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Address')</h2>
            @include('rapidez::account.partials.input', ['name' => 'street[0]', 'label' => 'Street', 'required' => true])
            @include('rapidez::account.partials.input', ['name' => 'street[1]', 'label' => false])
            @include('rapidez::account.partials.input', ['name' => 'street[2]', 'label' => false])

            @include('rapidez::account.partials.input', ['name' => 'country_code', 'label' => 'Country', 'required' => true])
            @include('rapidez::account.partials.input', ['name' => 'city', 'required' => true])
            @include('rapidez::account.partials.input', ['name' => 'postcode', 'required' => true])
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
