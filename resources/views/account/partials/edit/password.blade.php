<graphql-mutation query="mutation password ($currentPassword: String!, $newPassword: String!) { changeCustomerPassword ( currentPassword: $currentPassword, newPassword: $newPassword ) { email } }" :clear="true">
    <form
        v-on:submit.prevent="mutate"
        slot-scope="{ variables, mutate, mutated }"
        class="grid gap-5 lg:grid-cols-2"
    >
        <label>
            <x-rapidez::label>@lang('Current password')</x-rapidez::label>
            <x-rapidez::input.password
                v-model="variables.currentPassword"
                name="currentPassword"
                required
            />
        </label>
        <div class="flex flex-col">
            <label>
                <x-rapidez::label>@lang('New password')</x-rapidez::label>
                <x-rapidez::input.password
                    v-model="variables.newPassword"
                    name="newPassword"
                    required
                />
            </label>
            <x-rapidez::password-strength v-bind:password="variables.newPassword" class="my-2" />
        </div>
        <div class="mt-5 flex items-center">
            <x-rapidez::button.secondary type="submit">
                @lang('Change')
            </x-rapidez::button.secondary>

            <div v-if="mutated" class="ml-3 text-green-500">
                @lang('Changed successfully!')
            </div>
        </div>
    </form>
    <graphql-mutation>
