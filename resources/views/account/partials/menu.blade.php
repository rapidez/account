<ul class="flex flex-1 flex-col gap-1">
    <li>
        @include('rapidez::account.partials.menu-item', [
            'href' => route('account.overview'),
            'text' => __('Overview'),
            'icon' => 'heroicon-o-cog',
        ])
    </li>
    <li>
        @include('rapidez::account.partials.menu-item', [
            'href' => route('account.edit'),
            'text' => __('Account'),
            'icon' => 'heroicon-o-user',
        ])
    </li>
    <li>
        @include('rapidez::account.partials.menu-item', [
            'href' => route('account.addresses'),
            'text' => __('Addresses'),
            'icon' => 'heroicon-o-map',
        ])
    </li>
    <li>
        @include('rapidez::account.partials.menu-item', [
            'href' => route('account.orders'),
            'text' => __('Orders'),
            'icon' => 'heroicon-o-truck',
        ])
    </li>
    @if (App::providerIsLoaded('Rapidez\Wishlist\WishlistServiceProvider'))
        <li>
            @include('rapidez::account.partials.menu-item', [
                'href' => route('account.wishlist'),
                'text' => __('Wishlist'),
                'icon' => 'heroicon-o-heart',
            ])
        </li>
    @endif
</ul>
