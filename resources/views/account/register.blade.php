@extends('rapidez::layouts.app')

@section('title', 'Register')

@section('content')

    <div class="container mx-auto">
        <graphql-mutation query="mutation { createCustomerV2 ( input: changes ) { customer { firstname lastname email } } }">
            <form class="sm:w-1/3 md:w-1/4" slot-scope="{ changes, mutate, mutated }" v-on:submit.prevent="mutate">
           <x-rapidez::input
                name="firstname"
                v-model="changes.firstname"
                required
            />
            <x-rapidez::input
                name="lastname"
                v-model="changes.lastname"
                required
            />
            <x-rapidez::input
                name="email"
                v-model="changes.email"
                required
            />
            <x-rapidez::input
                name="password"
                v-model="changes.password"
                required
            />
            {{--<x-rapidez::input
                name="passwordConfirm"
                v-model="changes.passwordConfirm"
                required
            />--}}
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
