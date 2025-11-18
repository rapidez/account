@extends('rapidez::account.partials.layout')

@section('title', __('Account overview'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <div class="flex flex-col gap-4">
        <div class="bg p-6 rounded flex flex-col gap-3 sm:px-9 sm:pt-7 sm:pb-9">
            <x-rapidez::card.white href="{{ route('account.orders') }}">
                <x-heroicon-o-truck class="size-6"/>
                <div class="flex flex-col gap-y-1">
                    <span class="font-medium">@lang('Orders')</span>
                    <span class="text-muted">@lang('Place repeat order / View orders')</span>
                </div>
            </x-rapidez::card.white>
            @if (App::providerIsLoaded('Rapidez\Wishlist\WishlistServiceProvider'))
                <x-rapidez::card.white href="{{ route('account.orders') }}">
                    <x-heroicon-o-heart class="size-6"/>
                    <div class="flex flex-col gap-y-1">
                        <span class="font-medium">@lang('Wishlist')</span>
                        <span class="text-muted">@lang('View and edit products in your order list')</span>
                    </div>
                </x-rapidez::card.white>
            @endif
            <x-rapidez::card.white href="{{ route('account.edit') }}">
                <x-heroicon-o-cog class="size-6"/>
                <div class="flex flex-col gap-y-1">
                    <span class="font-medium">@lang('Account settings')</span>
                    <span class="text-muted">@lang('Change login details / Add addresses / Newsletters')</span>
                </div>
            </x-rapidez::card.white>
            <x-rapidez::card.white href="{{ route('account.addresses') }}">
                <x-heroicon-o-identification class="size-6"/>
                <div class="flex flex-col gap-y-1">
                    <span class="font-medium">@lang('Address book')</span>
                    <span class="text-muted">@lang('View / add and delete addresses')</span>
                </div>
            </x-rapidez::card.white>
            <user>
                <x-rapidez::card.white
                    v-on:click.prevent="logout('/login')"
                    slot-scope="{ logout }"
                    class="cursor-pointer"
                    data-testid="logout"
                >
                    <x-heroicon-o-arrow-right-start-on-rectangle class="size-6"/>
                    <div class="flex flex-col gap-y-1">
                        <span class="font-medium">@lang('Logout')</span>
                        <span class="text-muted">@lang('Log out from account')</span>
                    </div>
                </x-rapidez::card.white>
            </user>
        </div>
    </div>
@endsection
