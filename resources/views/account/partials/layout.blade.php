@extends('rapidez::layouts.app')

@section('title', __('Account'))

@section('content')
    <div class="container mx-auto" v-cloak>
        <div v-if="$root.user">
            @include('rapidez::account.partials.menu')
            <h1 class="font-bold text-4xl my-3">@yield('title')</h1>
            @yield('account-content')
        </div>
        <div v-else>
            @include('rapidez::account.partials.login', ['redirect' => false])
        </div>
    </div>
@endsection
