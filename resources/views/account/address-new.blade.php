@extends('rapidez::account.partials.layout')

@section('title', __('New address'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql-mutation
        query="@include('rapidez::account.partials.queries.address-create')"
        :variables="{ street: [] }"
        :callback="refreshUserInfoCallback"
        redirect="{{ route('account.addresses') }}"
    >
        @include('rapidez::account.partials.address-form')
    <graphql-mutation>
@endsection
