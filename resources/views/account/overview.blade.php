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
                <div class="flex">
                    <div class="w-1/2">
                        <h3 class="font-bold">@lang('Default billing address')</h3>
                        @{{ (billing = data.customer.addresses.find(a => a.default_billing == true)).firstname }} @{{ billing.lastname }}<br>
                        @{{ billing.street[0] }}<br>
                        @{{ billing.postcode }} @{{ billing.city }}<br>
                        @{{ billing.country_code }}<br>
                        T: @{{ billing.telephone }}
                    </div>
                    <div class="w-1/2">
                        <h3 class="font-bold">@lang('Default shipping address')</h3>
                        @{{ (shipping = data.customer.addresses.find(a => a.default_shipping == true)).firstname }} @{{ shipping.lastname }}<br>
                        @{{ shipping.street[0] }}<br>
                        @{{ shipping.postcode }} @{{ shipping.city }}<br>
                        @{{ shipping.country_code }}<br>
                        T: @{{ shipping.telephone }}
                    </div>
                </div>

                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Latest orders')</h2>
                @include('rapidez::account.partials.orders')
            </div>
        </graphql>
    </div>
@endsection
