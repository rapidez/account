<form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate">
    <div class="grid grid-cols-6 gap-4">
        <h2 class="col-span-6 font-bold text-2xl">@lang('Contact information')</h2>
        <div class="col-span-6 sm:col-span-3">
            <x-rapidez::input name="firstname" v-model="variables.firstname" :label="__('Firstname')"  required />
        </div>
        @if(Rapidez::config('customer/address/middlename_show', 0))
            <div class="col-span-6 sm:col-span-3">
                <x-rapidez::input name="middlename" v-model="variables.middlename" :label="__('Middlename')" />
            </div>
        @endif
        <div class="col-span-6 sm:col-span-3">
            <x-rapidez::input name="lastname" v-model="variables.lastname" :label="__('Lastname')"  required />
        </div>

        <div class="col-span-6 sm:col-span-3">
            @if(Rapidez::config('customer/address/company_show', 'opt'))
                <x-rapidez::input name="company" v-model="variables.company" :label="__('Company')" :required="Rapidez::config('customer/address/company_show', 'opt') == 'req'" />
            @endif
        </div>

        <div class="col-span-6 sm:col-span-3">
            @if(Rapidez::config('customer/address/telephone_show', 'req'))
                <x-rapidez::input name="telephone" v-model="variables.telephone" :label="__('Telephone')" :required="Rapidez::config('customer/address/telephone_show', 'req') == 'req'" />
            @endif
        </div>

        <h2 class="col-span-6 font-bold text-2xl mt-2">@lang('Address')</h2>
        <div class="col-span-6 sm:col-span-2">
            <x-rapidez::input name="street[0]" v-model="variables.street[0]" :label="__('Street')" :placeholder="__('Street')" required />
        </div>
        <div class="col-span-6 sm:col-span-2">
            @if(Rapidez::config('customer/address/street_lines', 2) >= 2)
                <x-rapidez::input name="street[1]" v-model="variables.street[1]" :label="__('Housenumber')" :placeholder="__('Nr.')" />
            @endif
        </div>
        <div class="col-span-6 sm:col-span-2">
            @if(Rapidez::config('customer/address/street_lines', 2) >= 3)
                <x-rapidez::input name="street[2]" v-model="variables.street[2]" :label="__('Addition')" :placeholder="__('Nr.')" />
            @endif
        </div>
        <div class="col-span-12 sm:col-span-6">
            @if(Rapidez::config('customer/address/street_lines', 2) >= 4)
                <x-rapidez::input name="street[3]" v-model="variables.street[3]" label="" placeholder="" />
            @endif
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-rapidez::input name="postcode" v-model="variables.postcode" :label="__('Postcode')" required />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-rapidez::input name="city" v-model="variables.city" :label="__('City')" required />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-rapidez::country-select
                name="country_code"
                :label="__('Country')"
                v-model="variables.country_code"
                class="w-full"
                required
            />
        </div>
        <div class="col-span-6">
            <x-rapidez::checkbox v-model="variables.default_billing">@lang('Default billing address')</x-rapidez::checkbox>
        </div>
        <div class="col-span-6">
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
