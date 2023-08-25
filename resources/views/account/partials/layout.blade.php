@extends('rapidez::layouts.app')

@section('title', __('Account'))

@section('content')
    <div class="bg-highlight -mt-5 pb-8 pt-5">
        <div
            v-cloak
            class="container mx-auto"
        >
            <div v-if="$root.user?.id">
                <h1 class="mb-5 text-3xl font-bold text-gray-700 max-sm:px-3">@yield('title')</h1>
                <div class="flex flex-wrap gap-10 max-sm:flex-col">
                    <div class="md:max-w-xs flex-1">
                        @include('rapidez::account.partials.menu')
                    </div>
                    <div class="flex-1 max-w-full">
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
