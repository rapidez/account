@extends('rapidez::layouts.app')

@section('title', __('Account'))

@section('content')
    <div class="-mt-5 bg-highlight pt-5 pb-8">
        <div
            class="container mx-auto"
            v-cloak
        >
            <div v-if="$root.user">
                <h1 class="max-sm:px-3 mb-5 text-3xl font-bold text-gray-700">@yield('title')</h1>
                <div class="max-sm:flex-col flex gap-10">
                    @include('rapidez::account.partials.menu')
                    <div class="w-full p-8">
                        @yield('account-content')
                    </div>
                </div>
            </div>
            <div v-else>
                @include('rapidez::account.partials.login', ['redirect' => false])
            </div>
        </div>
    </div>
@endsection
