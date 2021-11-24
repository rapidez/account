@extends('rapidez::account.partials.layout')

@section('title', __('Orders'))

@section('account-content')
    <div class="container mx-auto">
        <graphql v-cloak query="@include('rapidez::account.partials.queries.orders')">
            <div v-if="data" slot-scope="{ data }">
                @include('rapidez::account.partials.orders')
            </div>
        </graphql>
    </div>
@endsection
