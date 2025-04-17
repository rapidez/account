@props(['region' => 'region.region_id'])

<form slot-scope="{ variables, mutate, mutated }" v-on:submit.prevent="mutate">
    <div class="grid grid-cols-12 gap-4">
        <h2 class="col-span-12 font-bold text-2xl">@lang('Contact information')</h2>
        <div class="col-span-12 sm:col-span-6">
            <label>
                <x-rapidez::label>@lang('Firstname')</x-rapidez::label>
                <x-rapidez::input name="firstname" v-model="variables.firstname" required />
            </label>
        </div>
        @if(Rapidez::config('customer/address/middlename_show', 0))
            <div class="col-span-12 sm:col-span-6">
                <label>
                    <x-rapidez::label>@lang('Middlename')</x-rapidez::label>
                    <x-rapidez::input name="middlename" v-model="variables.middlename" />
                </label>
            </div>
        @endif
        <div class="col-span-12 sm:col-span-6">
            <label>
                <x-rapidez::label>@lang('Lastname')</x-rapidez::label>
                <x-rapidez::input name="lastname" v-model="variables.lastname" required />
            </label>
        </div>

        <div class="col-span-12 sm:col-span-6">
            @if(Rapidez::config('customer/address/company_show', 'opt'))
                <label>
                    <x-rapidez::label>@lang('Company')</x-rapidez::label>
                    <x-rapidez::input name="company" v-model="variables.company" :required="Rapidez::config('customer/address/company_show', 'opt') == 'req'" />
                </label>
            @endif
        </div>

        <div class="col-span-12 sm:col-span-6">
            @if(Rapidez::config('customer/address/taxvat_show', 0))
                <label>
                    <x-rapidez::label>@lang('Tax/VAT ID')</x-rapidez::label>
                    <x-rapidez::input
                        name="vat_id"
                        v-model="variables.vat_id"
                        v-on:change="window.app.$emit('vat-change', $event)"
                        :required="Rapidez::config('customer/address/taxvat_show', '0') == 'req'"
                    />
                </label>
            @endif
            @if(Rapidez::config('customer/address/telephone_show', 'req'))
                <label>
                    <x-rapidez::label>@lang('Telephone')</x-rapidez::label>
                    <x-rapidez::input name="telephone" v-model="variables.telephone" :required="Rapidez::config('customer/address/telephone_show', 'req') == 'req'" />
                </label>
            @endif
        </div>

        <h2 class="col-span-12 font-bold text-2xl mt-2">@lang('Address')</h2>
        <div class="col-span-12 sm:col-span-4">
            <label>
                <x-rapidez::label>@lang('Street')</x-rapidez::label>
                <x-rapidez::input name="street[0]" v-model="variables.street[0]" required />
            </label>
        </div>
        <div class="col-span-12 sm:col-span-4">
            @if(Rapidez::config('customer/address/street_lines', 2) >= 2)
                <label>
                    <x-rapidez::label>@lang('Housenumber')</x-rapidez::label>
                    <x-rapidez::input
                        name="street[1]"
                        v-model="variables.street[1]"
                        v-on:change="window.app.$emit('postcode-change', variables)"
                        required
                    />
                </label>
            @endif
        </div>
        <div class="col-span-12 sm:col-span-4">
            @if(Rapidez::config('customer/address/street_lines', 2) >= 3)
                <label>
                    <x-rapidez::label>@lang('Addition')</x-rapidez::label>
                    <x-rapidez::input name="street[2]" v-model="variables.street[2]" />
                </label>
            @endif
        </div>
        @if(Rapidez::config('customer/address/street_lines', 2) >= 4)
            <div class="col-span-12 sm:col-span-4">
                <x-rapidez::input name="street[3]" v-model="variables.street[3]" />
            </div>
        @endif
        <div class="col-span-12 sm:col-span-4">
            <label>
                <x-rapidez::label>@lang('Postcode')</x-rapidez::label>
                <x-rapidez::input
                    name="postcode"
                    v-model="variables.postcode"
                    v-on:change="window.app.$emit('postcode-change', variables)"
                    required
                />
            </label>
        </div>
        <div class="col-span-12 sm:col-span-4">
            <label>
                <x-rapidez::label>@lang('City')</x-rapidez::label>
                <x-rapidez::input name="city" v-model="variables.city" required />
            </label>
        </div>
        <div class="col-span-12 sm:col-span-4">
            <label>
                <x-rapidez::label>@lang('Country')</x-rapidez::label>
                <x-rapidez::input.select.country
                    name="country_code"
                    v-model="variables.country_code"
                    v-on:change="$root.$nextTick(() => {
                        window.app.$emit('postcode-change', variables);
                        variables.region = {};
                        variables.{{ $region }} = null;
                    })"
                    class="w-full"
                    required
                />
            </label>
        </div>
        <div class="col-span-12 sm:col-span-6 has-[.exists]:block hidden">
            <label>
                <x-rapidez::label>@lang('Region')</x-rapidez::label>
                <x-rapidez::input.select.region
                    class="exists"
                    name="{{ $type }}_region"
                    dusk="{{ $type }}_region"
                    country="variables.country_code"
                    v-model="variables.{{ $region }}"
                    :$useRegionId
                />
            </label>
        </div>
        <div class="col-span-12">
            <x-rapidez::input.checkbox v-model="variables.default_billing">@lang('Default billing address')</x-rapidez::input.checkbox>
        </div>
        <div class="col-span-12">
            <x-rapidez::input.checkbox v-model="variables.default_shipping">@lang('Default shipping address')</x-rapidez::input.checkbox>
        </div>
    </div>

    <div class="flex items-center mt-5">
        <x-rapidez::button.secondary type="submit">
            @lang(request()->id ? 'Change' : 'Add')
        </x-rapidez::button.secondary>

        <div v-if="mutated" class="ml-3 text-green-500">
            @lang('Changed successfully!')
        </div>
    </div>
</form>
