@extends('rapidez::layouts.app')

@section('title', __('Forgot password'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <graphql-mutation
        v-cloak
        query="mutation reset($email: String!) { requestPasswordResetEmail ( email: $email ) }"
        :clear="true"
        :notify="{ message: '@lang('An email is send with a password reset link if an account exists with the provided email address.')' }"
    >
        <div class="flex flex-col items-center" slot-scope="{ mutate, variables }">
            <div class="flex flex-col items-center rounded bg-highlight mt-3.5">
                <h1 class="mt-8 text-3xl font-bold">@lang('Forgot Your Password?')</h1>
                <form
                    class="flex w-[500px] flex-col gap-3 p-8"
                    v-on:submit.prevent="mutate"
                >
                    <x-rapidez::input
                        label="Email"
                        name="email"
                        type="email"
                        v-model="variables.email"
                        required
                    />

                    <x-rapidez::button
                        class="mt-2"
                        type="submit"
                    >
                        @lang('Reset password')
                    </x-rapidez::button>
                </form>
            </div>
        </div>
    </graphql-mutation>
@endsection
