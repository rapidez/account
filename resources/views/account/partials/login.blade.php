<login v-cloak :checkout-login="false" v-slot="login" redirect="{{ url($redirect ?? route('account.overview')) }}">
    <div v-if="!user.is_logged_in" class="flex flex-col items-center">
        <div class="flex flex-col items-center bg-highlight rounded mt-3.5 max-w-lg w-full">
            <h1 class="mt-8 text-3xl font-bold px-8">@lang('Login')</h1>
            <form class="flex flex-col gap-3 p-8 w-full" v-on:submit.prevent="login.go()">
                <x-rapidez::input
                    :label="false"
                    name="email"
                    type="email"
                    placeholder="Email"
                    v-model="login.email"
                    required
                />
                <x-rapidez::input
                    :label="false"
                    class="mt-2"
                    name="password"
                    type="password"
                    placeholder="Password"
                    v-model="login.password"
                    required
                />

                <x-rapidez::button type="submit" class="w-full my-5" dusk="continue">@lang('Login')</x-rapidez::button>

                <div class="flex justify-between">
                    <a href="{{ route('account.register') }}" class="text-sm hover:underline">@lang('Create an account')</a>
                    <a href="{{ route('account.forgotpassword') }}" class="text-sm hover:underline">@lang('Forgot your password?')</a>
                </div>
            </form>
        </div>
    </div>
</login>
