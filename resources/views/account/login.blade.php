@extends('rapidez::layouts.app')

@section('title', 'Login')

@section('content')
    <login v-cloak :checkout-login="false" v-slot="{ email, password, go, loginInputChange }">
        <div v-if="!$root.user" class="flex justify-center">
            <form class="p-8 border rounded w-[400px]" v-on:submit.prevent="go()">
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

                <x-rapidez::button type="submit" class="w-full mt-5" dusk="continue">@lang('Login')</x-rapidez::button>
            </form>
        </div>
    </login>
@endsection
