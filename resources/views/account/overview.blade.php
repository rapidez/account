@extends('rapidez::account.partials.layout')

@section('title', 'Account overview')

@section('account-content')
    <div class="container mx-auto">
        <graphql v-cloak query="{ customer { firstname lastname email addresses { firstname lastname street city postcode country_code telephone default_billing default_shipping } orders ( pageSize: 5 ) { items { number order_date shipping_address { firstname lastname } total { grand_total { value } } status } } } }">
            <div v-if="data" slot-scope="{ data }">
                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Account information')</h2>
                @{{ data.customer.firstname }} @{{ data.customer.lastname }}<br>
                @{{ data.customer.email }}

                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Addresses')</h2>
                @include('rapidez::account.partials.default-addresses')

                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Latest orders')</h2>
                @include('rapidez::account.partials.orders')
            </div>
        </graphql>
    </div>
@endsection
