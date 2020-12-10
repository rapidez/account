<div v-if="data.customer.orders" class="overflow-scroll md:overflow-visible">
    <table class="table-auto w-full text-left">
        <thead>
            <tr>
                <th class="px-4">@lang('Order #')</th>
                <th class="px-4">@lang('Date')</th>
                <th class="px-4">@lang('Ship to')</th>
                <th class="px-4">@lang('Order total')</th>
                <th class="px-4">@lang('Status')</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="order in data.customer.orders.items">
                <td class="border px-4 py-2">
                    <a :href="'/account/order/'+order.number" class="underline hover:no-underline">
                        @{{ order.number }}
                    </a>
                </td>
                <td class="border px-4 py-2">@{{ order.order_date }}</td>
                <td class="border px-4 py-2">@{{ order.shipping_address.firstname }} @{{ order.shipping_address.lastname }}</td>
                <td class="border px-4 py-2">@{{ order.total.grand_total.value | price }}</td>
                <td class="border px-4 py-2">@{{ order.status }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div v-else>@lang('You do not have any orders yet.')</div>
