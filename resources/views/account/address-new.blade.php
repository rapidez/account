@extends('rapidez::account.partials.layout')

@section('title', __('New address'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <div class="container mx-auto">
        <graphql-mutation query="@include('rapidez::account.partials.queries.address-create')" :variables="{ street: [] }" redirect="/account/addresses">
            @include('rapidez::account.partials.address-form')
        <graphql-mutation>
    </div>
@endsection
