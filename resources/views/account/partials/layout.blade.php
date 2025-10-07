@extends('rapidez::layouts.app')

@section('title', __('Account'))

@php
    $showNavigation = !request()->is('account');
@endphp

@section('content')
    <div v-cloak class="container mx-auto">
        <div v-if="$root.loggedIn">
            <h1 @attributes([
                'class' => 'mb-5 text-3xl font-bold max-sm:px-3',
                'data-testid' => Route::currentRouteName() == 'account.order' ? 'masked' : null
            ])>
                @yield('title')
            </h1>
            <div class="flex flex-wrap gap-10 max-lg:flex-col">
                <div class="max-w-full flex-1" data-testid="account-content">
                    @yield('account-content')
                </div>
                <div class="flex-1 lg:max-w-xs">
                    @includeWhen(!$showNavigation, 'rapidez::account.partials.sidebar')
                    @includeWhen($showNavigation, 'rapidez::account.partials.menu')
                </div>
            </div>
        </div>
        <div v-else>
            @include('rapidez::account.partials.login', ['redirect' => false])
        </div>
    </div>
@endsection
