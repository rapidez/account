<div class="rounded bg p-3">
    <div class="border flex flex-col gap-y-3 bg-white rounded px-8 pt-6 pb-3 text">
        <div class="text-lg text font-bold">@lang('Customer centre')</div>
        <ul class="flex flex-col gap-1 divide-y *:py-3">
            <li>
                @include('rapidez::account.partials.menu-item', [
                    'href' => route('account.orders'),
                    'text' => __('Orders'),
                ])
            </li>
            <li>
                @include('rapidez::account.partials.menu-item', [
                    'href' => route('account.edit'),
                    'text' => __('Account settings'),
                ])
            </li>
            <li>
                @include('rapidez::account.partials.menu-item', [
                    'href' => route('account.overview'),
                    'text' => __('Account overview'),
                ])
            </li>
            @if (App::providerIsLoaded('Rapidez\Wishlist\WishlistServiceProvider'))
                <li>
                    @include('rapidez::account.partials.menu-item', [
                        'href' => route('account.wishlist'),
                        'text' => __('Wishlist'),
                    ])
                </li>
            @endif
        </ul>
    </div>
</div>
