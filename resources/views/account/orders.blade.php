@extends('rapidez::account.partials.layout')

@section('title', __('Orders'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql query="@include('rapidez::account.partials.queries.orders')" :callback="sortOrdersCallback">
        <div v-if="data" slot-scope="{ data }">
            @include('rapidez::account.partials.orders')
        </div>
    </graphql>
@endsection
