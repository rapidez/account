<div v-if="data.customer.orders.items.length" class="max-w-full overflow-auto">
    <table class="text-left text-gray-700">
        <thead>
            <tr>
                <th class="px-4">@lang('Order #')</th>
                <th class="px-4">@lang('Date')</th>
                <th class="px-4">@lang('Ship to')</th>
                <th class="px-4">@lang('Order total')</th>
                <th class="px-4">@lang('Status')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="order in data.customer.orders.items">
                <td class="border px-4 py-2">
                    <a :href="'/account/order/'+order.number | url" class="underline hover:no-underline">
                        @{{ order.number }}
                    </a>
                </td>
                <td class="border px-4 py-2">@{{ order.order_date }}</td>
                <td class="border px-4 py-2">@{{ order.shipping_address?.firstname }} @{{ order.shipping_address?.lastname }}</td>
                <td class="border px-4 py-2">@{{ order.total.grand_total.value | price }}</td>
                <td class="border px-4 py-2">@{{ order.status }}</td>
                <td class="border px-4 py-2">
                    <graphql-mutation
                        query="@include('rapidez::account.queries.reorder-items')"
                        :variables="{orderNumber: order.number}"
                        redirect="{{ route('cart') }}"
                        :callback="reorderCallback"
                    >
                        <form slot-scope="{ mutate }" v-on:submit.prevent="mutate">
                            <x-rapidez::button type="submit" class="py-1 px-2 w-full">
                                @lang('Reorder')
                            </x-rapidez::button>
                        </form>
                    </graphql-mutation>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div v-else class="text-inactive">@lang('You do not have any orders yet.')</div>
