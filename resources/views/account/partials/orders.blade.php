<div v-if="data.customer.orders.items.length" class="max-w-full">
    <div v-for="order in data.customer.orders.items" class="border-b border-t bg-white mb-6 sm:rounded sm:border sm:mb-4">
        <div class="flex bg rounded-t border-b p-4 mb-4 max-xl:flex-col xl:grid xl:grid-cols-5 xl:gap-x-6 xl:p-6 xl:items-center">
            <dl class="gap-y-3 gap-x-6 text-sm grid grid-cols-4 xl:col-span-3">
                <div class="max-xl:col-span-2">
                    <dt class="font-medium text">@lang('Order number')</dt>
                    <dd class="mt-1 text-muted" data-testid="masked">
                        <a :href="'/account/order/'+order.number | url" class="underline hover:no-underline">
                            @{{ order.number }}
                        </a>
                    </dd>
                </div>
                <div class="max-xl:col-span-2">
                    <dt class="font-medium text">@lang('Order date')</dt>
                    <dd class="mt-1 text-muted" data-testid="masked">
                        <div>@{{ (new Date(order.order_date)).toLocaleDateString() }}</div>
                    </dd>
                </div>
                <div class="max-xl:col-span-2">
                    <dt class="font-medium text">@lang('Order total')</dt>
                    <dd class="mt-1 text-muted">@{{ order.total.grand_total.value | price }}</dd>
                </div>
                <div class="max-xl:col-span-2">
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
        <div class="divide-y">
            <x-rapidez::product-table v-for="item in order.items" class="px-4 py-2">
                <x-slot:image>
                    <img
                        :src="`/storage/{{ config('rapidez.store') }}/resizes/200/sku/${item.product_sku}`"
                        :alt="item.product_name"
                        height="200"
                        width="200"
                        class="object-contain mix-blend-multiply"
                    />
                </x-slot:image>
                <x-slot:name>@{{ item.product_name }}</x-slot:name>
                <x-slot:sku>@{{ item.product_sku }}</x-slot:sku>
                <x-slot:quantity>@{{ item.quantity_ordered }}</x-slot:quantity>
                <x-slot:price>@{{ item.product_sale_price.value | price }}</x-slot:price>
                <x-slot:subtotal>@{{ item.product_sale_price.value * item.quantity_ordered | price }}</x-slot:subtotal>
            </x-rapidez::product-table>
        </div>
        <div class="flex w-full justify-end px-4 mb-4">
            <graphql-mutation
                query="@include('rapidez::account.queries.reorder-items')"
                :variables="{orderNumber: order.number}"
                redirect="{{ route('cart') }}"
                :callback="reorderCallback"
            >
                <form slot-scope="{ mutate }" v-on:submit.prevent="mutate" class="mt-4">
                    <x-rapidez::button.secondary type="submit">
                        @lang('Reorder')
                    </x-rapidez::button.secondary>
                </form>
            </graphql-mutation>
        </div>
    </div>
</div>
<div v-else class="text-muted">@lang('You do not have any orders yet.')</div>
