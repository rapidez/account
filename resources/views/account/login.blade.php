@extends('rapidez::layouts.app')

@section('title', 'Login')

@section('content')
    <login v-cloak :checkout-login="false" v-slot="{ email, password, go, loginInputChange }">
        <div v-if="!$root.user" class="flex justify-center flex-col sm:flex-row">
            <form class="p-8 border rounded w-full sm:w-400px" v-on:submit.prevent="go()">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Login')</h1>

                <x-rapidez::input
                    :label="false"
                    name="email"
                    type="email"
                    v-bind:value="email"
                    v-on:input="loginInputChange"
                    required
                />
                <x-rapidez::input
                    :label="false"
                    class="mt-3"
                    name="password"
                    type="password"
                    v-bind:value="password"
                    v-on:input="loginInputChange"
                    required
                />
                <button
                    type="submit"
                    class="btn btn-primary w-full mt-5"
                    :disabled="$root.loading"
                    dusk="continue"
                >
                    @lang('Login')
                </button>
            </form>
            <div class="p-8 border rounded w-full sm:w-400px ml-0 sm:ml-1 mt-1 sm:mt-0">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Register')</h1>
                <p>@lang('Creating an account has many benefits: check out faster, keep more than one address, track orders and more.')</p>
                <a href="/register" aria-label="@lang('Register')" class="btn btn-primary mt-5">@lang('Create an account')</a>
            </div>
        </div>
    </login>
@endsection
