<login v-cloak :checkout-login="false" v-slot="{ email, password, go, loginInputChange }" redirect="{{ $redirect ?? '/account' }}">
    <div v-if="!$root.user" class="flex flex-col items-center">
        <div class="flex flex-col items-center bg-highlight rounded mt-3.5">
            <h1 class="mt-8 text-3xl font-bold">@lang('Login')</h1>
            <form class="flex w-[500px] flex-col gap-3 p-8" v-on:submit.prevent="go()">
                <x-rapidez::input
                    :label="false"
                    name="email"
                    type="email"
                    placeholder="Email"
                    v-bind:value="email"
                    v-on:input="loginInputChange"
                    required
                />
                <x-rapidez::input
                    :label="false"
                    class="mt-2"
                    name="password"
                    type="password"
                    placeholder="Password"
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
    </div>
</login>
