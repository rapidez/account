@extends('rapidez::account.partials.layout')

@section('title', __('Addresses'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <div class="container mx-auto">
        <graphql query="{ customer { addresses { id firstname middlename lastname street city postcode country_code telephone default_billing default_shipping } } }">
            <div v-if="data" slot-scope="{ data }">
                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Default addresses')</h2>
                @include('rapidez::account.partials.default-addresses', ['edit' => true])

                <div :set="data.customer.additionalAddresses = data.customer.addresses.filter(a => a.default_billing == false && a.default_shipping == false)">
                    <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Additional Address Entries')</h2>
                    <div v-if="data.customer.additionalAddresses.length">
                        <table class="table-auto w-full text-left text-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4">@lang('Firstname')</th>
                                    @if(Rapidez::config('customer/address/middlename_show', 0))
                                        <th class="px-4">@lang('Middlename')</th>
                                    @endif
                                    <th class="px-4">@lang('Lastname')</th>
                                    <th class="px-4">@lang('Address')</th>
                                    <th class="px-4">@lang('Zipcode')</th>
                                    <th class="px-4">@lang('City')</th>
                                    <th class="px-4">@lang('Country')</th>
                                    <th class="px-4">@lang('Phone')</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="additionalAddress in data.customer.additionalAddresses">
                                    <td class="border px-4 py-2">@{{ additionalAddress.firstname }}</td>
                                    @if(Rapidez::config('customer/address/middlename_show', 0))
                                        <td class="border px-4 py-2">@{{ additionalAddress.middlename }}</td>
                                    @endif
                                    <td class="border px-4 py-2">@{{ additionalAddress.lastname }}</td>
                                    <td class="border px-4 py-2">@{{ additionalAddress.street[0] }} @{{ additionalAddress.street[1] }} @{{ additionalAddress.street[2] }} @{{ additionalAddress.street[3] }}</td>
                                    <td class="border px-4 py-2">@{{ additionalAddress.postcode }}</td>
                                    <td class="border px-4 py-2">@{{ additionalAddress.city }}</td>
                                    <td class="border px-4 py-2">@{{ additionalAddress.country_code }}</td>
                                    @if(Rapidez::config('customer/address/telephone_show', 'opt'))
                                        <td class="border px-4 py-2">@{{ additionalAddress.telephone }}</td>
                                    @endif
                                    <td class="border px-4 py-2">
                                        <a :href="'/account/address/'+additionalAddress.id" class="underline hover:no-underline">
                                            @lang('Edit')
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <graphql-mutation :query="'mutation { deleteCustomerAddress ( id: '+additionalAddress.id+' ) }'" redirect="/account/addresses">
                                            <div slot-scope="{ mutate }">
                                                <button v-on:click="mutate" class="underline hover:no-underline">
                                                    @lang('Delete')
                                                </button>
                                            </div>
                                        </graphql-mutation>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-gray-700">
                        @lang('You have no other address entries in your address book.')
                    </div>

                    <x-rapidez::button href="/account/address/new" class="mt-5">
                        @lang('Add new address')
                    </x-rapidez::button>
                </div>
            </div>
        </graphql>
    </div>
@endsection
