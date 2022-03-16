@extends('rapidez::layouts.app')

@section('title', __('Register'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <x-rapidez::recaptcha location="customer_create"/>
    <graphql-mutation
        v-cloak
        query="mutation customer ($firstname: String!, $lastname: String!, $email: String!, $password: String) { createCustomerV2 ( input: { firstname: $firstname, lastname: $lastname, email: $email, password: $password } ) { customer { email } } }"
        redirect="/account"
        :callback="registerCallback"
        :recaptcha="{{ Rapidez::config('recaptcha_frontend/type_for/customer_create') == 'recaptcha_v3' ? 'true' : 'false' }}"
    >
        <div v-if="!$root.user" class="flex justify-center" slot-scope="{ mutate, variables }">
            <form class="p-8 border rounded w-[400px] mr-1" v-on:submit.prevent="mutate">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Register')</h1>
                <div class="space-y-3">
                    <x-rapidez::input
                        name="firstname"
                        type="text"
                        v-model="variables.firstname"
                        required
                    />
                    <x-rapidez::input
                        name="lastname"
                        type="text"
                        v-model="variables.lastname"
                        required
                    />
                    <x-rapidez::input
                        name="email"
                        type="email"
                        v-model="variables.email"
                        required
                    />
                    <x-rapidez::input
                        name="password"
                        type="password"
                        v-model="variables.password"
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
