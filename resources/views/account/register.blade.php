@extends('rapidez::layouts.app')

@section('title', 'Register')

@section('content')
    <graphql-mutation
        v-cloak
        query="mutation { createCustomerV2 ( input: changes ) { customer { email } } }"
        redirect="/account"
        :callback="registerCallback"
    >
        <div v-if="!$root.user" class="flex justify-center" slot-scope="{ mutate, changes }">
            <form class="p-8 border rounded w-[400px] mr-1" v-on:submit.prevent="mutate">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Register')</h1>
                <div class="space-y-3">
                    <x-rapidez::input
                        name="firstname"
                        type="text"
                        v-model="changes.firstname"
                        required
                    />
                    <x-rapidez::input
                        name="lastname"
                        type="text"
                        v-model="changes.lastname"
                        required
                    />
                    <x-rapidez::input
                        name="email"
                        type="email"
                        v-model="changes.email"
                        required
                    />
                    <x-rapidez::input
                        name="password"
                        type="password"
                        v-model="changes.password"
                        required
                    />

                    <x-rapidez::button type="submit" class="w-full">
                        @lang('Register')
                    </x-rapidez::button>
                </div>
            </form>
        </div>
        <div v-else>
            <div class="mb-5">@lang('You\'re already logged in.')</div>
            <x-rapidez::button href="/account">
                @lang('Go to your account')
            </x-rapidez::button>
        </div>
    </graphql-mutation>
@endsection
