<form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate">
    <div class="grid grid-cols-12 gap-4">
        <h2 class="col-span-12 font-bold text-2xl">@lang('Contact information')</h2>
        <div class="col-span-12 sm:col-span-6">
            <x-rapidez::input name="firstname" v-model="variables.firstname" label="Firstname"  required />
        </div>
        @if(Rapidez::config('customer/address/middlename_show', 0))
            <div class="col-span-12 sm:col-span-6">
                <x-rapidez::input name="middlename" v-model="variables.middlename" label="Middlename" />
            </div>
        @endif
        <div class="col-span-12 sm:col-span-6">
            <x-rapidez::input name="lastname" v-model="variables.lastname" label="Lastname" required />
        </div>

        <div class="col-span-12 sm:col-span-6">
            @if(Rapidez::config('customer/address/company_show', 'opt'))
                <x-rapidez::input name="company" v-model="variables.company" label="Company" :required="Rapidez::config('customer/address/company_show', 'opt') == 'req'" />
            @endif
        </div>

        <div class="col-span-12 sm:col-span-6">
                @if(Rapidez::config('customer/address/taxvat_show', 0))
                    <x-rapidez::input name="vat_id" label="Tax/VAT ID" placeholder="Tax/VAT ID" v-model="variables.vat_id" :required="Rapidez::config('customer/address/taxvat_show', '0') == 'req'" />
                @endif
            @if(Rapidez::config('customer/address/telephone_show', 'req'))
                <x-rapidez::input name="telephone" v-model="variables.telephone" label="Telephone" :required="Rapidez::config('customer/address/telephone_show', 'req') == 'req'" />
            @endif
        </div>

        <h2 class="col-span-12 font-bold text-2xl mt-2">@lang('Address')</h2>
        <div class="col-span-12 sm:col-span-4">
            <x-rapidez::input name="street[0]" v-model="variables.street[0]" label="Street" placeholder="Street" required />
        </div>
        <div class="col-span-12 sm:col-span-4">
            @if(Rapidez::config('customer/address/street_lines', 2) >= 2)
                <x-rapidez::input name="street[1]" v-model="variables.street[1]" label="Housenumber" placeholder="Nr." />
            @endif
        </div>
        <div class="col-span-12 sm:col-span-4">
            @if(Rapidez::config('customer/address/street_lines', 2) >= 3)
                <x-rapidez::input name="street[2]" v-model="variables.street[2]" label="Addition" placeholder="Nr." />
            @endif
        </div>
        @if(Rapidez::config('customer/address/street_lines', 2) >= 4)
            <div class="col-span-12 sm:col-span-4">
                    <x-rapidez::input name="street[3]" v-model="variables.street[3]" label="" placeholder="" />
            </div>
        @endif
        <div class="col-span-12 sm:col-span-4">
            <x-rapidez::input name="postcode" v-model="variables.postcode" label="Postcode" required />
        </div>
        <div class="col-span-12 sm:col-span-4">
            <x-rapidez::input name="city" v-model="variables.city" label="City" required />
        </div>
        <div class="col-span-12 sm:col-span-4">
            <x-rapidez::country-select
                name="country_code"
                label="Country"
                v-model="variables.country_code"
                class="w-full"
                required
            />
        </div>
        <div class="col-span-12">
            <x-rapidez::checkbox v-model="variables.default_billing">@lang('Default billing address')</x-rapidez::checkbox>
        </div>
        <div class="col-span-12">
            <x-rapidez::checkbox v-model="variables.default_shipping">@lang('Default shipping address')</x-rapidez::checkbox>
        </div>
    </div>

    <div class="flex items-center mt-5">
        <x-rapidez::button type="submit">
            @lang(request()->id ? 'Change' : 'Add')
        </x-rapidez::button>

        <div v-if="mutated" class="ml-3 text-green-500">
            @lang('Changed successfully!')
        </div>
    </div>
</form>
