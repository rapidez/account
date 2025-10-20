@extends('rapidez::account.partials.layout')

@section('title', __('Addresses'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql query="{ customer { addresses { id firstname middlename lastname street city postcode country_code telephone default_billing default_shipping } } }">
        <div v-if="data" slot-scope="{ data }">
            @include('rapidez::account.partials.default-addresses', ['edit' => true])
        </div>
    </graphql>
@endsection
