@extends('rapidez::account.partials.layout')

@section('title', 'New address')

@section('account-content')
    <div class="container mx-auto">
        <graphql-mutation v-cloak query="mutation { createCustomerAddress ( input: changes ) { id } }" :changes="{ street: [] }" redirect="/account/addresses">
            @include('rapidez::account.partials.address-form')
        <graphql-mutation>
    </div>
@endsection