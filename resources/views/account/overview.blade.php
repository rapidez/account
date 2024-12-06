@extends('rapidez::account.partials.layout')

@section('title', __('Account overview'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql query="@include('rapidez::account.partials.queries.overview')" :callback="sortOrdersCallback">
        <div class="flex flex-col gap-4" v-if="data" slot-scope="{ data }">
            <div>
                <h2 class="text-2xl font-bold">@lang('Account information')</h2>
                <div class="text-muted">
                    <span class="font-bold text">@lang('Name'):</span> @{{ data.customer.firstname }} @{{ data.customer.lastname }}<br>
                    <span class="font-bold text">@lang('Email'):</span> @{{ data.customer.email }}
                </div>
            </div>
            <div>
                <h2 class="text-2xl font-bold">@lang('Addresses')</h2>
                @include('rapidez::account.partials.default-addresses')
            </div>
            <div>
                <h2 class="text-2xl font-bold">@lang('Latest orders')</h2>
                @include('rapidez::account.partials.orders')
            </div>
        </div>
    </graphql>
@endsection
