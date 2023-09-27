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
        <div
            class="flex flex-col items-center rounded bg-highlight mt-3.5 max-w-lg w-full"
            v-if="!$root.user?.id"
        >
            <h1 class="mt-8 text-3xl font-bold px-8">@lang('Register your account')</h1>

            <form
                class="grid grid-cols-2 w-full gap-3 p-8"
                v-on:submit.prevent="mutate"
            >
                <div class="col-span-2 sm:col-span-1">
                    <x-rapidez::input
                        name="firstname"
                        type="text"
                        v-model="variables.firstname"
                        required
                    />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <x-rapidez::input
                        name="lastname"
                        type="text"
                        v-model="variables.lastname"
                        required
                    />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <x-rapidez::input
                        name="email"
                        type="email"
                        v-model="variables.email"
                        required
                    />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <x-rapidez::input
                        name="password"
                        type="password"
                        v-model="variables.password"
                        required
                    />

                    @if(Rapidez::config('customer/create_account/vat_frontend_visibility', 0))
                        <x-rapidez::input
                            name="taxvat"
                            label="Tax/VAT ID"
                            placeholder="Tax/VAT ID"
                            type="text"
                            v-model="variables.taxvat"
                        />
                    @endif
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
            <x-rapidez::button :href="route('account.overview')">
                @lang('Go to your account')
            </x-rapidez::button>
        </div>
    </div>
    </graphql-mutation>
@endsection
