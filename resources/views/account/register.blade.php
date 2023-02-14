@extends('rapidez::layouts.app')

@section('title', __('Register'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <x-rapidez::recaptcha location="customer_create" />
    <graphql-mutation
        v-cloak
        query="mutation customer ($firstname: String!, $lastname: String!, $email: String!, $password: String) { createCustomerV2 ( input: { firstname: $firstname, lastname: $lastname, email: $email, password: $password } ) { customer { email } } }"
        redirect="/account"
        :callback="registerCallback"
        :recaptcha="{{ Rapidez::config('recaptcha_frontend/type_for/customer_create') == 'recaptcha_v3' ? 'true' : 'false' }}"
    >
    <div class="flex flex-col items-center" slot-scope="{ mutate, variables }">
        <div
            class="flex flex-col items-center rounded bg-highlight mt-3.5"
            v-if="!$root.user"
        >
            <h1 class="mt-8 text-3xl font-bold">@lang('Register your account')</h1>

            <form
                class="grid grid-cols-2 w-full sm:w-[600px] gap-3 p-8"
                v-on:submit.prevent="mutate"
            >
                <div class="col-span-2 sm:col-span-1">
                    <x-rapidez::input
                        label="Firstname"
                        name="firstname"
                        type="text"
                        v-model="variables.firstname"
                        required
                    />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <x-rapidez::input
                        label="Lastname"
                        name="lastname"
                        type="text"
                        v-model="variables.lastname"
                        required
                    />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <x-rapidez::input
                        label="Email"
                        name="email"
                        type="email"
                        v-model="variables.email"
                        required
                    />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <x-rapidez::input
                        label="Password"
                        name="password"
                        type="password"
                        v-model="variables.password"
                        required
                    />
                </div>

                <x-rapidez::button
                    class="col-span-2"
                    type="submit"
                >
                    @lang('Register')
                </x-rapidez::button>
            </form>
        </div>
        <div v-else>
            <div class="mb-5">@lang('You\'re already logged in.')</div>
            <x-rapidez::button href="/account">
                @lang('Go to your account')
            </x-rapidez::button>
        </div>
    </div>
    </graphql-mutation>
@endsection
