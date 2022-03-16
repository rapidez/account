@extends('rapidez::account.partials.layout')

@section('title', __('Edit address'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <div class="container mx-auto">
        <graphql query="{ customer { addresses { id firstname lastname street city postcode country_code telephone company default_billing default_shipping } } }" check="data.customer.addresses.find(a => a.id == {{ request()->id }})" redirect="/account/orders">
            <div v-if="data" slot-scope="{ data }">
                <graphql-mutation query="@include('rapidez::account.partials.queries.address-edit')" :variables="Object.assign(data.customer.addresses.find(a => a.id == {{ request()->id }}), { id: {{ request()->id }} })" redirect="/account/addresses">
                    @include('rapidez::account.partials.address-form')
                <graphql-mutation>
            </div>
        </graphql>
    </div>
@endsection
