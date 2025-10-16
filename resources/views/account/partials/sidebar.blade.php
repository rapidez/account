<graphql query="@include('rapidez::account.partials.queries.overview')">
    <div v-if="data" slot-scope="{ data }" class="bg rounded p-3">
        <div class="border bg-white flex flex-col gap-y-4 rounded px-8 py-6 text divide-y">
            <div class="flex flex-col gap-y-2" data-testid="masked">
                <div class="text-lg text font-bold mb-2">@lang('Account information')</div>
                <div class="flex flex-col">
                    <strong>@lang('Name'):</strong>
                    <span>@{{ data.customer.firstname }} @{{ data.customer.lastname }}</span>
                </div>
                <div class="flex flex-col">
                    <strong>@lang('Email'):</strong>
                    <span class="break-words">@{{ data.customer.email }}</span>
                </div>
            </div>
            <div class="pt-2" v-if="data.customer.addresses.find(a => a.default_billing == true)">
                <strong>@lang('Default billing address')</strong>
                <ul>
                    <li>@{{ (billing = data.customer.addresses.find(a => a.default_billing == true)).firstname }} @{{ billing.lastname }}</li>
                    <li>@{{ billing.street[0] }} @{{ billing.street[1] }} @{{ billing.street[2] }}</li>
                    <li>@{{ billing.postcode }} @{{ billing.city }} @{{ billing.region?.region }} @{{ billing.country_code }}</li>
                    <li>T: @{{ billing.telephone }}</li>
                </ul>
            </div>
            <div class="pt-2" v-if="data.customer.addresses.find(a => a.default_shipping == true)">
                <strong>@lang('Default shipping address')</strong>
                <ul>
                    <li>@{{ (shipping = data.customer.addresses.find(a => a.default_shipping == true)).firstname }} @{{ shipping.lastname }}</li>
                    <li>@{{ shipping.street[0] }} @{{ shipping.street[1] }} @{{ shipping.street[2] }}</li>
                    <li>@{{ shipping.postcode }} @{{ shipping.city }} @{{ shipping.region?.region }} @{{ shipping.country_code }}</li>
                    <li>T: @{{ shipping.telephone }}<br></li>
                </ul>
            </div>
        </div>
    </div>
</graphql>