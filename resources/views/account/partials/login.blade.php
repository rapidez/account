<login v-cloak :checkout-login="false" v-slot="{ email, password, go, loginInputChange }" redirect="{{ $redirect ?? '/account' }}">
    <div v-if="!$root.user" class="flex flex-col items-center bg-highlight">
        <h1 class="my-5 text-3xl font-bold text-gray-700">@lang('Login')</h1>
        <form class="flex w-[500px] flex-col gap-3 p-8" v-on:submit.prevent="go()">
            <x-rapidez::input
                :label="false"
                name="email"
                type="email"
                v-bind:value="email"
                v-on:input="loginInputChange"
                required
            />
            <x-rapidez::input
                :label="false"
                class="mt-2"
                name="password"
                type="password"
                v-bind:value="password"
                v-on:input="loginInputChange"
                required
            />

            <x-rapidez::button type="submit" class="w-full my-5" dusk="continue">@lang('Login')</x-rapidez::button>

            <div class="flex justify-between">
                <a href="/register" class="text-sm hover:underline">@lang('Create an account')</a>
                <a href="/forgotpassword" class="text-sm hover:underline">@lang('Forgot your password?')</a>
            </div>
        </form>
    </div>
</login>
