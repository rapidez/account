@extends('rapidez::layouts.app')

@section('title', 'Register')

@section('content')
    <register v-cloak v-slot="{ firstname, lastname, email, password, password_confirmation, go, inputChange }">
        <div v-if="!$root.user" class="flex justify-center">
            <form class="p-8 border rounded w-400px mr-1" v-on:submit.prevent="go()">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Register')</h1>
                <x-rapidez::input
                    :label="false"
                    name="firstname"
                    type="text"
                    v-bind:value="firstname"
                    v-on:input="inputChange"
                    required
                />
                <x-rapidez::input
                    :label="false"
                    name="lastname"
                    type="text"
                    v-bind:value="lastname"
                    v-on:input="inputChange"
                    required
                />
                <x-rapidez::input
                    :label="false"
                    name="email"
                    type="email"
                    v-bind:value="email"
                    v-on:input="inputChange"
                    required
                />
                <x-rapidez::input
                    :label="false"
                    class="mt-3"
                    name="password"
                    type="password"
                    v-bind:value="password"
                    v-on:input="inputChange"
                    required
                />
                <x-rapidez::input
                    :label="false"
                    class="mt-3"
                    name="password_confirmation"
                    placeholder="Password Confirmation"
                    type="password"
                    v-bind:value="password_confirmation"
                    v-on:input="inputChange"
                    required
                />
                <button
                    type="submit"
                    class="btn btn-primary w-full mt-5"
                    :disabled="$root.loading"
                    dusk="continue"
                >
                    @lang('Register')
                </button>
            </form>
        </div>
    </register>
@endsection
