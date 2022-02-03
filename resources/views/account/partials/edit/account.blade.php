<graphql query="{ customer { firstname lastname } }">
    <div v-if="data" slot-scope="{ data }">
        <graphql-mutation query="mutation { updateCustomerV2 ( input: changes ) { customer { firstname lastname } } }" :changes="data.customer" :callback="refreshUserInfoCallback">
            <form slot-scope="{ changes, mutate, mutated }" v-on:submit.prevent="mutate">
                <x-rapidez::input name="firstname" v-model="changes.firstname" class="mb-2"/>
                <x-rapidez::input name="lastname" v-model="changes.lastname"/>

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
