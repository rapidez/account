<graphql query="{ customer { firstname middlename lastname } }">
    <div v-if="data" slot-scope="{ data }">
        <graphql-mutation query="mutation customer ($firstname: String, $middlename: String, $lastname: String) { updateCustomerV2 ( input: { firstname: $firstname, middlename: $middlename, lastname: $lastname } ) { customer { firstname middlename lastname } } }" :variables="data.customer" :callback="refreshUserInfoCallback">
            <form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate" class="flex flex-col gap-y-2">
                <label>
                    <x-rapidez::label>@lang('Firstname')</x-rapidez::label>
                    <x-rapidez::input name="firstname" v-model="variables.firstname" required />
                </label>
                @if(Rapidez::config('customer/address/middlename_show', 0))
                    <label>
                        <x-rapidez::label>@lang('Middlename')</x-rapidez::label>
                        <x-rapidez::input name="middlename" v-model="variables.middlename" />
                    </label>
                @endif
                <label>
                    <x-rapidez::label>@lang('Lastname')</x-rapidez::label>
                    <x-rapidez::input name="lastname" v-model="variables.lastname" required/>
                </label>

                <div class="flex items-center mt-5">
                    <x-rapidez::button.secondary type="submit">
                        @lang('Change')
                    </x-rapidez::button.secondary>

                    <div v-if="mutated" class="ml-3 text-green-500">
                        @lang('Changed successfully!')
                    </div>
                </div>
            </form>
        <graphql-mutation>
    </div>
</graphql>
