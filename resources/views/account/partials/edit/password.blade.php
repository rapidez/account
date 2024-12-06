<graphql-mutation query="mutation password ($currentPassword: String!, $newPassword: String!) { changeCustomerPassword ( currentPassword: $currentPassword, newPassword: $newPassword ) { email } }" :clear="true">
    <form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate" class="flex flex-col gap-y-2">
        <label>
            <x-rapidez::label>@lang('Current password')</x-rapidez::label>
            <x-rapidez::input.password
                name="currentPassword"
                v-model="variables.currentPassword"
                required
            />
        </label>
        <label>
            <x-rapidez::label>@lang('New password')</x-rapidez::label>
            <x-rapidez::input.password
                name="newPassword"
                v-model="variables.newPassword"
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
<graphql-mutation>
