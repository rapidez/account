<div v-if="data.customer.orders.items.length" class="max-w-full">
    <div v-for="order in data.customer.orders.items" class="border-b border-t bg-white mb-6 sm:rounded sm:border sm:mb-4">
        <div class="flex bg rounded-t border-b p-4 mb-4 max-xl:flex-col xl:grid xl:grid-cols-5 xl:gap-x-6 xl:p-6 xl:items-center">
            <dl class="flex flex-wrap flex-1 gap-y-3 gap-x-6 text-sm xl:grid xl:col-span-3 xl:grid-cols-4">
                <div>
                    <dt class="font-medium text">@lang('Order number')</dt>
                    <dd class="mt-1 text-muted" data-testid="masked">
                        <a :href="'/account/order/'+order.number | url" class="underline hover:no-underline">
                            @{{ order.number }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="font-medium text">@lang('Order date')</dt>
                    <dd class="mt-1 text-muted" data-testid="masked">
                        <div>@{{ (new Date(order.order_date)).toLocaleDateString() }}</div>
                    </dd>
                </div>
                <div>
                    <dt class="font-medium text">@lang('Order total')</dt>
                    <dd class="mt-1 text-muted">@{{ order.total.grand_total.value | price }}</dd>
                </div>
                <div>
                    <dt class="font-medium text">@lang('Status')</dt>
                    <dd class="mt-1 text-muted">@{{ order.status }}</dd>
                </div>
            </dl>
            <div class="col-span-2 flex items-center justify-end space-x-4 max-xl:w-full max-xl:mt-3">
                <a :href="'/account/order/'+order.number | url" class="flex items-center justify-center rounded-md border bg-white text p-2" data-testid="order-id">
                    <span>@lang('View order')</span>
                </a>
            </div>
        </div>
        <ul>
            <li v-for="item in order.items" class="px-4 py-2">
                <div class="flex items-center sm:items-start">
                    <div class="flex size-20 shrink-0 bg-muted rounded">
                        <img
                            :src="`/storage/{{ config('rapidez.store') }}/resizes/200/sku/${item.product_sku}`"
                            :alt="item.product_name"
                            height="80"
                            width="80"
                            class="object-contain mix-blend-multiply"
                        />
                    </div>
                    <div class="ml-6 flex-1 text-sm">
                        <div class="text sm:flex sm:justify-between">
                            <div class="flex flex-col">
                                <strong>@{{ item.product_name }}</strong>
                                <span class="text-muted">@{{ item.product_sku }}</span>
                            </div>
                            <div class="flex items-center gap-x-4">
                                <p class="mt-2 sm:mt-0">@{{ item.quantity_ordered }}x</p>
                                <p class="mt-2 sm:mt-0">@{{ item.product_sale_price.value | price }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="flex w-full justify-end px-4 mb-4">
            <graphql-mutation
                query="@include('rapidez::account.queries.reorder-items')"
                :variables="{orderNumber: order.number}"
                redirect="{{ route('cart') }}"
                :callback="reorderCallback"
            >
            <form slot-scope="{ mutate }" v-on:submit.prevent="mutate">
                <x-rapidez::button.secondary type="submit">
                    @lang('Reorder')
                </x-rapidez::button.secondary>
            </form>
        </graphql-mutation>
        </div>
    </div>

</div>
<div v-else class="text-muted">@lang('You do not have any orders yet.')</div>
