@extends('rapidez::account.partials.layout')

@section('title', 'Orders')

@section('account-content')
    <div class="container mx-auto">
        <graphql v-cloak query="{ customer { orders { items { number order_date shipping_address { firstname lastname } total { grand_total { value } } status } } } }">
            <div v-if="data" slot-scope="{ data }">
                @include('rapidez::account.partials.orders')
            </div>
        </graphql>
    </div>
@endsection
