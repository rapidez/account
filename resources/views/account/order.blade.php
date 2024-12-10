@extends('rapidez::account.partials.layout')

@section('title', __('Order').' #'.request()->id)

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql query='@include('rapidez::account.partials.queries.order')' :variables="{orderNumber: '{{ request()->id }}'}" check="(data) => data.customer.orders.items[0]" redirect="{{ route('account.orders') }}">
        <div v-if="data" slot-scope="{ data }">
            <div class="overflow-auto max-w-full">
                <table class="text-left text-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">@lang('Product name')</th>
                            <th class="px-4 py-2">@lang('SKU')</th>
                            <th class="px-4 py-2 text-right">@lang('Price')</th>
                            <th class="px-4 py-2 text-right">@lang('Qty')</th>
                            <th class="px-4 py-2 text-right">@lang('Subtotal')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in data.customer.orders.items[0].items">
                            <td class="border px-4 py-2">@{{ product.product_name }}</td>
                            <td class="border px-4 py-2">@{{ product.product_sku }}</td>
                            <td class="border px-4 py-2 text-right">@{{ product.product_sale_price.value | price }}</td>
                            <td class="border px-4 py-2 text-right">@{{ product.quantity_ordered }}</td>
                            <td class="border px-4 py-2 text-right">@{{ product.product_sale_price.value * product.quantity_ordered | price }}</td>
                        </tr>
                    </tbody>
                    <tfoot class="text-right">
                        <tr>
                            <td class="border px-4 py-2" colspan="4">@lang('Subtotal')</td>
                            <td class="border px-4 py-2">@{{ data.customer.orders.items[0].total.subtotal.value | price }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2" colspan="4">@lang('Shipping & Handling')</td>
                            <td class="border px-4 py-2">@{{ data.customer.orders.items[0].total.shipping_handling.total_amount.value | price }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2" colspan="4">@lang('Grand Total')</td>
                            <td class="border px-4 py-2 font-bold">@{{ data.customer.orders.items[0].total.grand_total.value | price }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h2 class="font-bold text-2xl mt-5">@lang('Order information')</h2>
            <div class="flex flex-wrap">
                <div class="w-full sm:w-1/2 lg:w-1/4 mt-3" v-if="shipping = data.customer.orders.items[0].shipping_address">
                    <h3 class="font-bold text-xl">@lang('Shipping address')</h3>
                    <div class="text-gray-700">
                        @{{ shipping.firstname }} @{{ shipping.lastname }}<br>
                        @{{ shipping.street[0] }} @{{ shipping.street[1] }}<br>
                        @{{ shipping.postcode }} @{{ shipping.city }}<br>
                        @{{ shipping.country_code }}<br>
                        T: @{{ shipping.telephone }}
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 mt-3" v-if="data.customer.orders.items[0].shipping_method">
                    <h3 class="font-bold text-xl">@lang('Shipping method')</h3>
                    <div class="text-gray-700">
                        @{{ data.customer.orders.items[0].shipping_method }}
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 mt-3">
                    <h3 class="font-bold text-xl">@lang('Billing address')</h3>
                    <div class="text-gray-700">
                        @{{ (billing = data.customer.orders.items[0].billing_address).firstname }} @{{ billing.lastname }}<br>
                        @{{ billing.street[0] }} @{{ billing.street[1] }}<br>
                        @{{ billing.postcode }} @{{ billing.city }}<br>
                        @{{ billing.country_code }}<br>
                        T: @{{ billing.telephone }}
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 mt-3">
                    <h3 class="font-bold text-xl">@lang('Payment method')</h3>
                    <div class="text-gray-700">
                        @{{ data.customer.orders.items[0].payment_methods[0].name }}
                    </div>
                </div>
            </div>
        </div>
    </graphql>
@endsection
