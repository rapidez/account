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
            <div v-for="product in data.customer.orders.items[0].items" class="flex space-x-6 border-b py-6">
                <div class="flex size-20 shrink-0 bg-muted rounded">
                    <img
                        :src="`/storage/{{ config('rapidez.store') }}/resizes/200/sku/${product.product_sku}`"
                        :alt="product.product_name"
                        height="80"
                        width="80"
                        class="object-contain mix-blend-multiply"
                    />
                </div>
                <div class="flex flex-col">
                    <div class="flex flex-col">
                        <strong>@{{ product.product_name }}</strong>
                        <span class="text-muted text-sm">@{{ product.product_sku }}</span>
                    </div>
                    <ul v-if="product.selected_options" class="flex divide-x mt-1 text-sm">
                        <li v-for="option in product.selected_options" class="first:pl-0 px-1">
                            <span class="text">@{{ option.label }}:</span>
                            <span class="text-muted">@{{ option.value }}</span>
                        </li>
                    </ul>
                    <div class="mt-3 flex flex-1 items-end lg:mt-6">
                        <dl class="flex flex-wrap divide-x text-sm">
                            <div class="flex pr-2">
                                <dt class="font-bold">@lang('Quantity'):</dt>
                                <dd class="ml-1">@{{ product.quantity_ordered }}</dd>
                            </div>
                            <div class="flex px-2">
                                <dt class="font-bold">@lang('Price'):</dt>
                                <dd class="ml-1">@{{ product.product_sale_price.value | price }}</dd>
                            </div>
                            <div class="flex pl-2">
                                <dt class="font-bold">@lang('Subtotal'):</dt>
                                <dd class="ml-1">@{{ product.product_sale_price.value * product.quantity_ordered | price }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg rounded p-6 mt-6">
                <div class="grid grid-cols-2 gap-x-6 gap-y-3 max-md:pb-5 md:grid-cols-4">
                    <dl class="grid col-span-2 gap-x-6 gap-y-3 md:py-5 text-sm md:grid-cols-2">
                        <div v-if="shipping = data.customer.orders.items[0].shipping_address">
                            <dt class="font-bold xl:text-xl">@lang('Shipping address')</dt>
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
                            <dt class="font-bold xl:text-xl">@lang('Billing address')</dt>
                            <dd class="mt-2">
                                <div v-if="data.customer.orders.items[0].shipping_method">
                                    @{{ (billing = data.customer.orders.items[0].billing_address).firstname }} @{{ billing.lastname }}<br>
                                    @{{ billing.street[0] }} @{{ billing.street[1] }}<br>
                                    @{{ billing.postcode }} @{{ billing.city }}<br>
                                    @{{ billing.country_code }}<br>
                                    T: @{{ billing.telephone }}
                                </div>
                            </dd>
                        </div>
                    </dl>
                    <dl class="grid col-span-2 gap-x-6 gap-y-3 md:py-5 text-sm md:grid-cols-2">
                        <div>
                            <dt class="font-bold xl:text-xl">@lang('Payment method')</dt>
                            <dd class="mt-2">
                                <div>
                                    @{{ data.customer.orders.items[0].payment_methods[0].name }}
                                </div>
                            </dd>
                        </div>
                        <div>
                            <dt class="font-bold xl:text-xl">@lang('Shipping method')</dt>
                            <dd class="mt-2">
                                <div>
                                    @{{ data.customer.orders.items[0].shipping_method }}
                                </div>
                            </dd>
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
