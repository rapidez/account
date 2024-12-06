<login v-cloak :checkout-login="false" v-slot="login" redirect="{{ url($redirect ?? route('account.overview')) }}">
    <div v-if="!user.is_logged_in" class="flex flex-col items-center">
        <div class="flex flex-col items-center bg rounded mt-3.5 max-w-lg w-full">
            <h1 class="mt-8 text-3xl font-bold px-8">@lang('Login')</h1>
            <form class="flex flex-col gap-3 p-8 w-full" v-on:submit.prevent="login.go()">
                <x-rapidez::input
                    name="email"
                    type="email"
                    :placeholder="__('Email')"
                    v-model="login.email"
                    required
                />
                <x-rapidez::input.password
                    name="password"
                    :placeholder="__('Password')"
                    v-model="login.password"
                    required
                />

                <x-rapidez::button.secondary type="submit" class="w-full my-5" dusk="continue">@lang('Login')</x-rapidez::button.secondary>

                <div class="flex justify-between">
                    <a href="{{ route('account.register') }}" class="text-sm hover:underline">@lang('Create an account')</a>
                    <a href="{{ route('account.forgotpassword') }}" class="text-sm hover:underline">@lang('Forgot your password?')</a>
                </div>
            </form>
        </div>
    </div>
</login>
