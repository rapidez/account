@extends('rapidez::layouts.app')

@section('title', __('Register'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
<div class="min-h-screen">
    <x-rapidez::recaptcha location="customer_create" />
    <graphql-mutation
        v-cloak
        query="mutation customer ($firstname: String!, $lastname: String!, $email: String!, $password: String, $taxvat: String) { createCustomerV2 ( input: { firstname: $firstname, lastname: $lastname, email: $email, password: $password, taxvat: $taxvat } ) { customer { email } } }"
        redirect="{{ route('account.overview') }}"
        :callback="registerCallback"
        :recaptcha="{{ Rapidez::config('recaptcha_frontend/type_for/customer_create') == 'recaptcha_v3' ? 'true' : 'false' }}"
    >
        <div class="flex flex-col items-center" slot-scope="{ mutate, variables }">
            <div v-if="!loggedIn" class="w-full container">
                <h1 class="mt-6 text-3xl font-bold">@lang('Register your account')</h1>
                <div class="mt-5 flex w-full gap-8 max-lg:flex-col">
                    <div class="flex-1">
                        <form v-on:submit.prevent="mutate" id="register" class="grid w-full grid-cols-2 gap-3 rounded bg p-8">
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
                                <div class="flex-col">
                                    <x-rapidez::input.password
                                        v-model="variables.password"
                                        name="password"
                                        :placeholder="__('Password')"
                                        required
                                    />
                                    <div class="mt-3">
                                        <x-rapidez::password-strength v-bind:password="variables.password"/>
                                    </div>
                                </div>
                            </div>
                            @if (Rapidez::config('customer/create_account/vat_frontend_visibility', 0))
                                <div class="col-span-full">
                                    <x-rapidez::input
                                        v-model="variables.taxvat"
                                        name="taxvat"
                                        label="Tax/VAT ID"
                                        :placeholder="__('Tax/VAT ID')"
                                        type="text"
                                    />
                                </div>
                            @endif
                        </form>
                        <div class="flex items-center justify-between mt-5">
                            <x-rapidez::button.outline href="{{ route('account.login') }}">
                                @lang('Go back to login')
                            </x-rapidez::button.outline>
                            <x-rapidez::button.secondary form="register" type="submit" data-testid="continue">
                                @lang('Register')
                            </x-rapidez::button.secondary>
                        </div>
                    </div>
                    <div class="bg w-full p-3 self-start lg:w-80">
                        <div class="border bg-white p-8">
                            <div class="font-bold text-lg">@lang('Account features')</div>
                            <ul class="space-y-5 my-5 text-sm *:flex *:items-start *:gap-x-2">
                                <li>
                                    <x-heroicon-s-check class="stroke-2 text-primary shrink-0 size-4"/>
                                    @lang('Track status of your order and view order history')
                                </li>
                                <li>
                                    <x-heroicon-s-check class="stroke-2 text-primary shrink-0 size-4"/>
                                    @lang('Quick and easy ordering without having to fill in your details every time')
                                </li>
                                <li>
                                    <x-heroicon-s-check class="stroke-2 text-primary shrink-0 size-4"/>
                                    @lang('Everything centralized in 1 place such as returns, exchanges and customer service')
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="mb-5">@lang('You\'re already logged in.')</div>
                <x-rapidez::button.secondary :href="route('account.overview')">
                    @lang('Go to your account')
                </x-rapidez::button.secondary>
            </div>
        </div>
    </graphql-mutation>
</div>
@endsection
