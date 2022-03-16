<graphql query="{ customer { firstname lastname } }">
    <div v-if="data" slot-scope="{ data }">
        <graphql-mutation query="mutation customer ($firstname: String, $lastname: String) { updateCustomerV2 ( input: { firstname: $firstname, lastname: $lastname } ) { customer { firstname lastname } } }" :variables="data.customer" :callback="refreshUserInfoCallback">
            <form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate">
                <x-rapidez::input name="firstname" v-model="variables.firstname" class="mb-2"/>
                <x-rapidez::input name="lastname" v-model="variables.lastname"/>

                <div class="flex items-center mt-5">
                    <x-rapidez::button type="submit">
                        @lang('Change')
                    </x-rapidez::button>

                    <div v-if="mutated" class="ml-3 text-green-500">
                        @lang('Changed successfully!')
                    </div>
                </div>
            </form>
        <graphql-mutation>
    </div>
</graphql>
