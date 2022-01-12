@extends('rapidez::account.partials.layout')

@section('title', __('New address'))

@section('account-content')
    <div class="container mx-auto">
        <graphql-mutation query="mutation { createCustomerAddress ( input: changes ) { id } }" :changes="{ street: [] }" redirect="/account/addresses">
            @include('rapidez::account.partials.address-form')
        <graphql-mutation>
    </div>
@endsection
