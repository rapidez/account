@extends('rapidez::account.partials.layout')

@section('title', 'Addresses')

@section('account-content')
    <div class="container mx-auto">
        <graphql v-cloak query="{ customer { addresses { id firstname lastname street city postcode country_code telephone default_billing default_shipping } } }">
            <div v-if="data" slot-scope="{ data }">
                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Default addresses')</h2>
                @include('rapidez::account.partials.default-addresses', ['edit' => true])

                <div :set="additionalAddresses = data.customer.addresses.filter(a => a.default_billing == false && a.default_shipping == false)">
                    <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Additional Address Entries')</h2>
                    <div v-if="additionalAddresses.length">
                        <table class="table-auto w-full text-left">
                            <thead>
                                <tr>
                                    <th class="px-4">@lang('Firstname')</th>
                                    <th class="px-4">@lang('Lastname')</th>
                                    <th class="px-4">@lang('Address')</th>
                                    <th class="px-4">@lang('Zipcode')</th>
                                    <th class="px-4">@lang('City')</th>
                                    <th class="px-4">@lang('Country')</th>
                                    <th class="px-4">@lang('Phone')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="additionalAddress in additionalAddresses">
                                    <td class="border px-4 py-2">@{{ additionalAddress.firstname }}</td>
                                    <td class="border px-4 py-2">@{{ additionalAddress.lastname }}</td>
                                    <td class="border px-4 py-2">@{{ billing.street[0] }} @{{ billing.street[1] }} @{{ billing.street[2] }}</td>
                                    <td class="border px-4 py-2">@{{ billing.postcode }}</td>
                                    <td class="border px-4 py-2">@{{ additionalAddress.city }}</td>
                                    <td class="border px-4 py-2">@{{ additionalAddress.country_code }}</td>
                                    <td class="border px-4 py-2">@{{ additionalAddress.telephone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else>
                        @lang('You have no other address entries in your address book.')
                    </div>

                    <a href="/account/address/new" class="btn btn-primary mt-5">@lang('Add new address')</a>
                </div>
            </div>
        </graphql>
    </div>
@endsection
