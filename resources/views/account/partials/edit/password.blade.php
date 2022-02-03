<graphql-mutation query="mutation password ($currentPassword: String!, $newPassword: String!) { changeCustomerPassword ( currentPassword: $currentPassword, newPassword: $newPassword ) { email } }" :clear="true">
    <form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate">
        <x-rapidez::input
            type="password"
            label="Current password"
            placeholder="Current password"
            name="currentPassword"
            v-model="variables.currentPassword"
            required
            class="mb-2"
        />
        <x-rapidez::input
            type="password"
            label="New password"
            placeholder="New password"
            name="newPassword"
            v-model="variables.newPassword"
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
