@extends('rapidez::layouts.app')

@section('title', 'Register')

@section('content')
    <div class="flex justify-center">
        <graphql-mutation before="checkPassword" query="mutation { createCustomerV2 ( input: changes ) { customer { firstname lastname email } } }">
            <form class="sm:w-1/3 md:w-1/4" slot-scope="{ changes, beforeParams, mutate, mutated }" v-on:submit.prevent="mutate">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Register account')</h1>
                <x-rapidez::input
                    name="firstname"
                    label="First name"
                    v-model="changes.firstname"
                    required
                />
                <x-rapidez::input
                    name="lastname"
                    label="Last name"
                    v-model="changes.lastname"
                    required
                />
                <x-rapidez::input
                    name="email"
                    label="E-mail"
                    type="email"
                    v-model="changes.email"
                    required
                />
                <x-rapidez::input
                    name="password"
                    label="Password"
                    type="password"
                    v-model="changes.password"
                    required
                />
                <x-rapidez::input
                    name="passwordConfirm"
                    label="Confirm password"
                    type="password"
                    v-model="beforeParams.passwordConfirm"
                    required
                />
                <div class="flex items-center mt-5">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        :disabled="$root.loading"
                    >
                        @lang('Create')
                    </button>

                    <div v-if="mutated" class="ml-3 text-green-500">
                        @lang('Account created successfully!')
                    </div>
                </div>
            </form>
        </graphql-mutation>
    </div>
@endsection
