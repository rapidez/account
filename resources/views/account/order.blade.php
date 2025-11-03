@extends('rapidez::account.partials.layout')

@section('title', __('Order').' #'.request()->id)

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <graphql
        query='@include('rapidez::account.partials.queries.order')'
        :variables="{orderNumber: '{{ request()->id }}'}"
        :check="(data) => data.customer.orders.items[0]"
        redirect="{{ route('account.orders') }}"
    >
        <div v-if="data" slot-scope="{ data }">
            <x-rapidez::product-table v-for="product in data.customer.orders.items[0].items">
                <x-slot:image>
                    <img
                        :src="`/storage/{{ config('rapidez.store') }}/resizes/200/sku/${product.product_sku}`"
                        :alt="product.product_name"
                        height="200"
                        width="200"
                        class="object-contain mix-blend-multiply"
                    />
                </x-slot:image>
                <x-slot:name>@{{ product.product_name }}</x-slot:name>
                <x-slot:sku>@{{ product.product_sku }}</x-slot:sku>
                <x-slot:options>
                    <ul v-if="product.selected_options" class="flex divide-x mt-1 text-sm">
                        <li v-for="option in product.selected_options" class="first:pl-0 px-1">
                            <span class="text">@{{ option.label }}:</span>
                            <span class="text-muted">@{{ option.value }}</span>
                        </li>
                    </ul>
                </x-slot:options>
                <x-slot:quantity>@{{ product.quantity_ordered }}</x-slot:quantity>
                <x-slot:price>@{{ product.product_sale_price.value | price  }}</x-slot:price>
                <x-slot:subtotal>@{{ product.product_sale_price.value * product.quantity_ordered | price }}</x-slot:subtotal>
            </x-rapidez::product-table>

            <div class="bg rounded p-6 mt-6">
                <div class="grid grid-cols-2 gap-x-6 gap-y-3 max-md:pb-5 md:grid-cols-4">
                    <dl class="grid col-span-2 gap-x-6 gap-y-3 md:py-5 text-sm md:grid-cols-2">
                        <div v-if="shipping = data.customer.orders.items[0].shipping_address">
                            <dt class="font-bold xl:text-lg">@lang('Shipping address')</dt>
                            <dd class="mt-2">
                                <div>
                                    @{{ shipping.firstname }} @{{ shipping.lastname }}<br>
                                    @{{ shipping.street[0] }} @{{ shipping.street[1] }}<br>
                                    @{{ shipping.postcode }} @{{ shipping.city }} @{{ shipping.country_code }}<br>
                                    T: @{{ shipping.telephone }}
                                </div>
                            </dd>
                        </div>
                        <div>
                            <dt class="font-bold xl:text-lg">@lang('Billing address')</dt>
                            <dd class="mt-2">
                                <div v-if="data.customer.orders.items[0].shipping_method">
                                    @{{ (billing = data.customer.orders.items[0].billing_address).firstname }} @{{ billing.lastname }}<br>
                                    @{{ billing.street[0] }} @{{ billing.street[1] }}<br>
                                    @{{ billing.postcode }} @{{ billing.city }} @{{ billing.country_code }}<br>
                                    T: @{{ billing.telephone }}
                                </div>
                            </dd>
                        </div>
                    </dl>
                    <dl class="grid col-span-2 gap-x-6 gap-y-3 md:py-5 text-sm md:grid-cols-2">
                        <div>
                            <dt class="font-bold xl:text-lg">@lang('Payment method')</dt>
                            <dd class="mt-2">@{{ data.customer.orders.items[0].payment_methods[0].name }}</dd>
                        </div>
                        <div>
                            <dt class="font-bold xl:text-lg">@lang('Shipping method')</dt>
                            <dd class="mt-2">@{{ data.customer.orders.items[0].shipping_method }}</dd>
                        </div>
                    </dl>
                </div>
                <dl class="space-y-6 border-t pt-5 xl:*:w-1/3">
                    <div class="flex justify-between">
                        <dt class="font-bold">@lang('Subtotal')</dt>
                        <dd>@{{ data.customer.orders.items[0].total.subtotal.value | price }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-bold">@lang('Shipping & Handling')</dt>
                        <dd>@{{ data.customer.orders.items[0].total.shipping_handling.total_amount.value | price }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-bold ">@lang('Grand Total')</dt>
                        <dd>@{{ data.customer.orders.items[0].total.grand_total.value | price }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </graphql>
    <x-rapidez::button.outline href="{{ route('account.orders') }}" class="mt-4">
        @lang('Go back to orders')
    </x-rapidez::button.outline>
@endsection
