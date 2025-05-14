@extends('rapidez::layouts.app')

@section('title', __('Register'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <x-rapidez::recaptcha location="customer_create" />
    <graphql-mutation
        v-cloak
        query="mutation customer ($firstname: String!, $lastname: String!, $email: String!, $password: String, $taxvat: String) { createCustomerV2 ( input: { firstname: $firstname, lastname: $lastname, email: $email, password: $password, taxvat: $taxvat } ) { customer { email } } }"
        redirect="{{ route('account.overview') }}"
        :callback="registerCallback"
        :recaptcha="{{ Rapidez::config('recaptcha_frontend/type_for/customer_create') == 'recaptcha_v3' ? 'true' : 'false' }}"
    >
        <div class="flex flex-col items-center" slot-scope="{ mutate, variables }">
            <div v-if="!loggedIn" class="mt-3.5 flex w-full max-w-lg flex-col items-center rounded bg">
                <h1 class="mt-8 px-8 text-3xl font-bold">@lang('Register your account')</h1>

                <form v-on:submit.prevent="mutate" class="grid w-full grid-cols-2 gap-3 p-8">
                    <div class="max-sm:col-span-2">
                        <x-rapidez::input
                            v-model="variables.firstname"
                            name="firstname"
                            type="text"
                            :placeholder="__('Firstname')"
                            required
                        />
                    </div>
                    <div class="max-sm:col-span-2">
                        <x-rapidez::input
                            v-model="variables.lastname"
                            name="lastname"
                            type="text"
                            :placeholder="__('Lastname')"
                            required
                        />
                    </div>
                    <div class="max-sm:col-span-2">
                        <x-rapidez::input
                            v-model="variables.email"
                            name="email"
                            type="email"
                            :placeholder="__('Email')"
                            required
                        />
                    </div>
                    <div class="max-sm:col-span-2">
                        <x-rapidez::input.password
                            v-model="variables.password"
                            name="password"
                            :placeholder="__('Password')"
                            required
                        />
                        @if (Rapidez::config('customer/create_account/vat_frontend_visibility', 0))
                            <x-rapidez::input
                                v-model="variables.taxvat"
                                name="taxvat"
                                label="Tax/VAT ID"
                                :placeholder="__('Tax/VAT ID')"
                                type="text"
                            />
                        @endif
                    </div>
                    <div class="col-span-full">
                        <x-rapidez::password-strength v-bind:password="variables.password"/>
                    </div>
                    <x-rapidez::button.secondary class="col-span-full" type="submit">
                        @lang('Register')
                    </x-rapidez::button.secondary>
                </form>
            </div>
            <div v-else>
                <div class="mb-5">@lang('You\'re already logged in.')</div>
                <x-rapidez::button.secondary :href="route('account.overview')">
                    @lang('Go to your account')
                </x-rapidez::button.secondary>
            </div>
        </div>
    </graphql-mutation>
@endsection
