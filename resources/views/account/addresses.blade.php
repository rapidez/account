@extends('rapidez::account.partials.layout')

@section('title', __('Addresses'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql query="{ customer { addresses { id firstname middlename lastname street city postcode country_code telephone default_billing default_shipping } } }" v-slot="{ data }">
        <div v-if="data" class="bg rounded p-6 flex flex-col gap-y-2 sm:px-9 sm:pt-7 sm:pb-9">
            <h2 class="mb-2 text-lg font-bold">@lang('My addresses')</h2>
            @include('rapidez::account.partials.addresses')
        </div>
    </graphql>
@endsection