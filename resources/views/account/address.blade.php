@extends('rapidez::account.partials.layout')

@section('title', 'Edit address')

@section('account-content')
    <div class="container mx-auto">
        <graphql v-cloak query="{ customer { addresses { id firstname lastname street city postcode country_code telephone company default_billing default_shipping } } }" check="data.customer.addresses.find(a => a.id == {{ request()->id }})" redirect="/account/orders">
            <div v-if="data" slot-scope="{ data }" :set="address = data.customer.addresses.find(a => a.id == {{ request()->id }})">
                <graphql-mutation query="mutation { updateCustomerAddress ( id: {{ request()->id }}, input: changes ) { id } }" :changes="address">
                    <form slot-scope="{ changes, mutate, mutated }" v-on:submit.prevent="mutate">
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Contact information')</h2>
                                @include('rapidez::account.partials.input', ['name' => 'firstname'])
                                @include('rapidez::account.partials.input', ['name' => 'lastname'])
                                @include('rapidez::account.partials.input', ['name' => 'company'])
                                @include('rapidez::account.partials.input', ['name' => 'telephone'])
                            </div>

                            <div class="w-1/2">
                                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Address')</h2>
                                @include('rapidez::account.partials.input', ['name' => 'street[0]', 'label' => 'Street'])
                                @include('rapidez::account.partials.input', ['name' => 'street[1]', 'label' => false])
                                @include('rapidez::account.partials.input', ['name' => 'street[2]', 'label' => false])

                                @include('rapidez::account.partials.input', ['name' => 'country_code', 'label' => 'Country'])
                                @include('rapidez::account.partials.input', ['name' => 'city'])
                                @include('rapidez::account.partials.input', ['name' => 'postcode'])
                            </div>
                        </div>

                        <div class="flex items-center mt-5">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="$root.loading"
                            >
                                @lang('Change')
                            </button>

                            <div v-if="mutated" class="ml-3 text-green-500">
                                @lang('Changed successfully!')
                            </div>
                        </div>
                    </form>
                <graphql-mutation>
            </div>
        </graphql>
    </div>
@endsection
