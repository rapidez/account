@extends('rapidez::layouts.app')

@section('title', 'Forgot password')

@section('content')
    <graphql-mutation
        v-cloak
        query="mutation reset($email: String!) { requestPasswordResetEmail ( email: $email ) }"
        :clear="true"
        :notify="{ message: '@lang('An email is send with a password reset link if an account exists with the provided email address.')' }"
    >
        <div class="flex justify-center" slot-scope="{ mutate, variables }">
            <form class="p-8 border rounded w-[400px] mr-1" v-on:submit.prevent="mutate">
                <h1 class="font-bold text-4xl text-center mb-5">@lang('Forgot Your Password?')</h1>
                <x-rapidez::input
                    name="email"
                    type="email"
                    v-model="variables.email"
                    required
                />

                <x-rapidez::button type="submit" class="w-full mt-5">
                    @lang('Reset password')
                </x-rapidez::button>
            </form>
        </div>
    </graphql-mutation>
@endsection
