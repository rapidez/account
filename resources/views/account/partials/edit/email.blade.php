<graphql-mutation query="mutation email ($email: String!, $password: String!) { updateCustomerEmail ( email: $email, password: $password ) { customer { email } } }" :clear="true" :callback="refreshUserInfoCallback">
    <form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate">
        <x-rapidez::input
            label="Email"
            name="email"
            v-model="variables.email"
            required
            class="mb-2"
        />
        <x-rapidez::input
            label="Password"
            type="password"
            name="password"
            v-model="variables.password"
            required
        />

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
