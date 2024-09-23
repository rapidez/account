@extends('rapidez::layouts.app')

@section('title', __('Account'))

@section('content')
    <div class="bg-inactive-100 -mt-5 pb-8 pt-5">
        <div v-cloak class="container mx-auto">
            <div v-if="$root.user?.id">
                <h1 class="mb-5 text-3xl font-bold text-neutral max-sm:px-3">@yield('title')</h1>
                <div class="flex flex-wrap gap-10 max-sm:flex-col">
                    <div class="flex-1 md:max-w-xs">
                        @include('rapidez::account.partials.menu')
                    </div>
                    <div class="max-w-full flex-1">
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
