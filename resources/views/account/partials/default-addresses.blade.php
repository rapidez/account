<div class="flex flex-wrap gap-5">
    <div class="flex-1">
        <h3 class="font-bold text-gray-700">@lang('Default billing address')</h3>
        <div class="text-gray-700" v-if="data.customer.addresses.find(a => a.default_billing == true)">
            @{{ (billing = data.customer.addresses.find(a => a.default_billing == true)).firstname }} @{{ billing.lastname }}<br>
            @{{ billing.street[0] }} @{{ billing.street[1] }} @{{ billing.street[2] }}<br>
            @{{ billing.postcode }} @{{ billing.city }}<br>
            @{{ billing.country_code }}<br>
            T: @{{ billing.telephone }}<br>
            @isset($edit)
                <a :href="'/account/address/'+billing.id" class="underline hover:no-underline text-primary">@lang('Change billing address')</a>
            @endisset
        </div>

        <x-rapidez::button v-else href="/account/address/new" class="mt-5">
            @lang('Add billing address')
        </x-rapidez::button>
    </div>
    <div class="flex-1">
        <h3 class="font-bold text-gray-700">@lang('Default shipping address')</h3>
        <div class="text-gray-700" v-if="data.customer.addresses.find(a => a.default_shipping == true)">
            @{{ (shipping = data.customer.addresses.find(a => a.default_shipping == true)).firstname }} @{{ shipping.lastname }}<br>
            @{{ shipping.street[0] }} @{{ shipping.street[1] }} @{{ shipping.street[2] }}<br>
            @{{ shipping.postcode }} @{{ shipping.city }}<br>
            @{{ shipping.country_code }}<br>
            T: @{{ shipping.telephone }}<br>
            @isset($edit)
                <a :href="'/account/address/'+shipping.id" class="underline hover:no-underline text-primary">@lang('Change shipping address')</a>
            @endisset
        </div>

        <x-rapidez::button v-else href="/account/address/new" class="mt-5">
            @lang('Add shipping address')
        </x-rapidez::button>
    </div>
</div>
