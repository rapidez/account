@extends('rapidez::account.partials.layout')

@section('title', __('Orders'))

@section('account-content')
    <div class="container mx-auto">
        <graphql query="@include('rapidez::account.partials.queries.orders')" :callback="sortOrdersCallback">
            <div v-if="data" slot-scope="{ data }">
                @include('rapidez::account.partials.orders')
            </div>
        </graphql>
    </div>
@endsection
