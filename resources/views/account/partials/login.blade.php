<login v-cloak :checkout-login="false" v-slot="login" redirect="{{ url($redirect ?? route('account.overview')) }}">
    <div v-if="!user.is_logged_in" class="container mx-auto max-w-4xl w-full">
        <h1 class="mt-6 text-3xl font-bold">@lang('Login')</h1>
        <div class="mt-5 grid content-center items-start gap-8 lg:grid-cols-2">
            <div class="flex flex-col flex-1">
                <div class="flex flex-col items-center bg rounded w-full">
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

                        <x-rapidez::button.secondary type="submit" class="w-full my-5" dusk="continue">
                            @lang('Login')
                        </x-rapidez::button.secondary>

                        <div class="flex justify-between">
                            <a href="{{ route('account.forgotpassword') }}" class="text-sm hover:underline">@lang('Forgot your password?')</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border rounded p-8 w-full lg:w-96">
                <div class="font-bold text-lg">@lang('Register within 1 minute')</div>
                <p class="my-5 text-sm">
                    @lang('Don\'t have an account yet? Create an account and enjoy faster ordering, repeat orders, status of your order, easy returns and more!')
                </p>
                <x-rapidez::button.outline href="{{ route('account.register') }}">
                    @lang('Create an account')
                </x-rapidez::button.outline>
            </div>
        </div>
    </div>
</login>
