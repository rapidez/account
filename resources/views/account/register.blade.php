@extends('rapidez::layouts.app')

@section('content')
<register query="mutation { createCustomerV2 ( input: changes ) { customer { firstname lastname email } } }">
    <form class="sm:w-1/3 md:w-1/4" slot-scope="{changes, mutate, mutated, checks, checkPassword}" v-on:submit.prevent="checkPassword()">
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
        v-model="checks.checkPassword"
        required
        />

        <x-rapidez::button type="submit">
        Register
    </x-rapidez::button>
</form>
</register>
@endsection
