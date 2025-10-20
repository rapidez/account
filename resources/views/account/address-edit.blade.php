@extends('rapidez::account.partials.layout')

@section('title', __('Edit address'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql
        query="{ customer { addresses { id firstname middlename lastname street city postcode country_code region { region_id } telephone company default_billing default_shipping } } }"
        :check="(data) => data.customer.addresses.find(a => a.id == {{ request()->id }})"
        redirect="{{ route('account.orders') }}"
        v-slot="{ data }"
    >
    <div v-if="data">
            <graphql-mutation
                query="@include('rapidez::account.partials.queries.address-edit')"
                :variables="Object.assign(data.customer.addresses.find(a => a.id == {{ request()->id }}), { id: {{ request()->id }} })"
                :callback="refreshUserInfoCallback"
                redirect="{{ route('account.addresses') }}"
                v-slot="{ variables, mutate, mutated }"
            >
                @include('rapidez::account.partials.address-form')
    </graphql-mutation>
        </div>
    </graphql>
@endsection
