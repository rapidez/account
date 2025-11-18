@extends('rapidez::account.partials.layout')

@section('title', __('Orders'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql
        query="@include('rapidez::account.partials.queries.orders')"
        :callback="sortOrdersCallback"
        :variables="{
            pageSize: 5,
            page: 1,
        }"
    >
        <div slot-scope="{ data, variables, runQuery }">
            <template v-if="data && !$root.loading">
                <div
                    v-if="data.customer.orders.items.length == variables.pageSize"
                    class="text-inactive text-sm"
                >
                    @lang('Page') @{{ variables.page }}
                </div>

                @include('rapidez::account.partials.orders')

                <div class="flex mt-2">
                    <x-rapidez::button.secondary
                        v-if="variables.page > 1"
                        v-on:click="() => { variables.page--; runQuery(); window.scrollTo(0,0) }"
                    >
                        @lang('Previous page')
                    </x-rapidez::button.secondary>
                    <x-rapidez::button.secondary
                        v-if="data.customer.orders.items.length == variables.pageSize"
                        v-on:click="() => { variables.page++; runQuery(); window.scrollTo(0,0) }"
                        class="ml-auto"
                    >
                        @lang('Next page')
                    </x-rapidez::button.secondary>
                </div>
            </template>
        </div>
    </graphql>
@endsection
