@extends('rapidez::account.partials.layout')

@section('title', 'Account overview')

@section('account-content')
    <div class="container mx-auto">
        <graphql v-cloak query="@include('rapidez::account.partials.queries.overview')">
            <div v-if="data" slot-scope="{ data }">
                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Account information')</h2>
                <div class="text-gray-700">
                    @{{ data.customer.firstname }} @{{ data.customer.lastname }}<br>
                    @{{ data.customer.email }}
                </div>

                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Addresses')</h2>
                @include('rapidez::account.partials.default-addresses')

                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Latest orders')</h2>
                @include('rapidez::account.partials.orders')
            </div>
        </graphql>
    </div>
@endsection
