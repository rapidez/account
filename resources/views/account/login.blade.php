@extends('rapidez::layouts.app')

@section('title', 'Login')

@section('content')
    <login v-cloak :checkout-login="false" v-slot="{ email, password, go, loginInputChange }">
        <div v-if="!$root.user" class="flex justify-center">
            <form class="p-8 border rounded w-400px" v-on:submit.prevent="go()">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Login')</h1>
                <input
                    class="form-input w-full"
                    id="email"
                    type="email"
                    dusk="email"
                    placeholder="@lang('Email')"
                    :value="email"
                    @input="loginInputChange"
                    required
                >
                <input
                    class="form-input w-full mt-3"
                    id="password"
                    type="password"
                    dusk="password"
                    placeholder="@lang('Password')"
                    :value="password"
                    @input="loginInputChange"
                    required
                >
                <button
                    type="submit"
                    class="btn btn-primary w-full mt-5"
                    :disabled="$root.loading"
                    dusk="continue"
                >
                    @lang('Login')
                </button>
            </form>
        </div>
    </login>
@endsection
