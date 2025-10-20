@extends('rapidez::layouts.app')

@section('title', __('Forgot your password?'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <graphql-mutation
        v-cloak
        query="mutation reset($email: String!) { requestPasswordResetEmail ( email: $email ) }"
        :clear="true"
        :notify="{ message: '@lang('An email has been sent with a password reset link if an account exists with the provided email address.')' }"
    >
        <div class="flex flex-col items-center" slot-scope="{ mutate, variables }">
            <div class="flex flex-col items-center rounded bg mt-3.5 max-w-lg w-full">
                <h1 class="mt-8 text-3xl font-bold px-8">
                    @lang('Forgot your password?')
                </h1>
                <form v-on:submit.prevent="mutate" class="flex w-full flex-col gap-3 p-8">
                    <x-rapidez::input
                        name="email"
                        type="email"
                        :placeholder="__('Email')"
                        v-model="variables.email"
                        required
                    />

                    <x-rapidez::button.secondary type="submit" class="mt-2">
                        @lang('Reset password')
                    </x-rapidez::button.secondary>
                </form>
            </div>
        </div>
    </graphql-mutation>
@endsection
