<graphql-mutation query="mutation email ($email: String!, $password: String!) { updateCustomerEmail ( email: $email, password: $password ) { customer { email } } }" :clear="true" :callback="refreshUserInfoCallback" v-slot="{ variables, mutate, mutated }">
    <form v-on:submit.prevent="mutate" class="grid gap-5 lg:grid-cols-2">
        <label>
            <x-rapidez::label>@lang('Email')</x-rapidez::label>
            <x-rapidez::input
                name="email"
                v-model="variables.email"
                required
            />
        </label>
        <label>
            <x-rapidez::label>@lang('Password')</x-rapidez::label>
            <x-rapidez::input.password
                type="password"
                name="password"
                v-model="variables.password"
                required
            />
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
</graphql-mutation>
