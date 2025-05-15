@extends('rapidez::layouts.app')

@section('title', __('Reset password'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <graphql-mutation
        v-cloak
        query="mutation reset($email: String!, $token: String!, $password: String!) { resetPassword ( email: $email, resetPasswordToken: $token, newPassword: $password ) }"
        :variables="{ token: '{{ request()->token }}' }"
        :clear="true"
        :notify="{ message: '@lang('Your password has been changed, please login.')' }"
    >
        <div class="flex justify-center" slot-scope="{ mutate, variables }">
            <form v-on:submit.prevent="mutate" class="mr-1 w-[400px] rounded border p-8">
                <h1 class="mb-5 text-center text-4xl font-bold">@lang('Reset password')</h1>
                <div class="space-y-3">
                    <x-rapidez::input
                        v-model="variables.token"
                        name="token"
                        label="Security token"
                        class="hidden"
                        required
                    />
                    <label>
                        <x-rapidez::label>@lang('Email')</x-rapidez::label>
                        <x-rapidez::input
                            v-model="variables.email"
                            name="email"
                            type="email"
                            required
                        />
                    </label>
                    <label>
                        <x-rapidez::label>@lang('New password')</x-rapidez::label>
                        <x-rapidez::input.password
                            v-model="variables.password"
                            name="password"
                            required
                        />
                    </label>
                    <x-rapidez::password-strength v-bind:password="variables.password"/>
                </div>
                <x-rapidez::button.secondary type="submit" class="mt-5 w-full">
                    @lang('Change password')
                </x-rapidez::button.secondary>
            </form>
        </div>
    </graphql-mutation>
@endsection
