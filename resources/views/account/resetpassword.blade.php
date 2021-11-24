@extends('rapidez::layouts.app')

@section('title', __('Reset password'))

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
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Reset Password')</h1>
                <div class="space-y-3">
                    <x-rapidez::input
                        name="token"
                        v-model="variables.token"
                        label="Security token"
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
                        label="New password"
                        required
                    />
                </div>

                <x-rapidez::button type="submit" class="w-full mt-5">
                    @lang('Change password')
                </x-rapidez::button>
            </form>
        </div>
    </graphql-mutation>
@endsection
