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
                    class="text-inactive text-sm"
                    v-if="data.customer.orders.items.length == variables.pageSize"
                >
                    @lang('Page') @{{ variables.page }}
                </div>

                @include('rapidez::account.partials.orders')

                <div class="flex mt-2">
                    <x-rapidez::button.accent
                        v-if="variables.page > 1"
                        v-on:click="() => { variables.page--; runQuery(); window.scrollTo(0,0) }"
                    >
                        @lang('Previous page')
                    </x-rapidez::button.accent>
                    <x-rapidez::button.accent
                        class="ml-auto"
                        v-if="data.customer.orders.items.length == variables.pageSize"
                        v-on:click="() => { variables.page++; runQuery(); window.scrollTo(0,0) }"
                    >
                        @lang('Next page')
                    </x-rapidez::button.accent>
                </div>
            </template>
        </div>
    </graphql>
@endsection
