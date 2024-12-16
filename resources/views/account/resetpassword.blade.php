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
            <form class="p-8 border rounded w-[400px] mr-1" v-on:submit.prevent="mutate">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Reset password')</h1>
                <div class="space-y-3">
                    <x-rapidez::input
                        name="token"
                        v-model="variables.token"
                        label="Security token"
                        required
                    />
                    <label>
                        <x-rapidez::label>@lang('Email')</x-rapidez::label>
                        <x-rapidez::input
                            name="email"
                            type="email"
                            v-model="variables.email"
                            required
                    />
                    </label>
                    <label>
                        <x-rapidez::label>@lang('New password')</x-rapidez::label>
                        <x-rapidez::input.password
                            name="password"
                            v-model="variables.password"
                            required
                        />
                    </label>
                </div>

                <x-rapidez::button.secondary type="submit" class="w-full mt-5">
                    @lang('Change password')
                </x-rapidez::button.secondary>
            </form>
        </div>
    </graphql-mutation>
@endsection
