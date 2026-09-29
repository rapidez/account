
<expire-login v-slot="login">
    <div v-if="login.isTokenExpiring" v-cloak>
        <div class="fixed sm:max-w-sm sm:w-full bottom-6 right-6 left-6 sm:right-auto flex flex-col z-notifications">
            <label for="expire-login-slideover" class="hover:cursor-pointer">
                <div class="max-w-sm w-full rounded-lg pointer-events-auto ring-1 ring-emphasis/10 overflow-hidden border bg">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="shrink-0">
                                <x-heroicon-o-exclamation-triangle class="size-6"/>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium">
                                    @lang('You are about to be logged out :relativeExpireText, click here to refresh your session for uninterrupted browsing.', ['relativeExpireText' => '@{{ login.relativeExpireText }}'])
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </label>
        </div>
        <x-rapidez::slideover id="expire-login-slideover" :title="__('Login')">
            <div class="flex flex-col items-center rounded-sm mt-3.5 px-5">
                <form class="flex flex-col gap-3 w-full" v-on:submit.prevent="login.go()">
                    <p>@lang('You are about to be logged out :relativeExpireText, please login to refresh your session for uninterrupted browsing.', ['relativeExpireText' => '@{{ login.relativeExpireText }}'])</p>
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

                    <x-rapidez::button.secondary type="submit" class="w-full my-5" dusk="continue">@lang('Renew session')</x-rapidez::button.secondary>
                </form>
            </div>
        </x-rapidez::slideover>
    </div>
</expire-login>
