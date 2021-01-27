@extends('rapidez::account.partials.layout')

@section('title', 'Edit account')

@section('account-content')
    <div class="container mx-auto">
        <graphql v-cloak query="{ customer { firstname lastname } }">
            <div v-if="data" slot-scope="{ data }">
                <graphql-mutation query="mutation { updateCustomerV2 ( input: changes ) { customer { firstname lastname } } }" :changes="data.customer" :refresh-user-info="true">
                    <form class="sm:w-1/3 md:w-1/4" slot-scope="{ changes, mutate, mutated }" v-on:submit.prevent="mutate">
                        <x-rapidez::input name="firstname" v-model="changes.firstname" class="mb-2"/>
                        <x-rapidez::input name="lastname" v-model="changes.lastname"/>

                        <div class="flex items-center mt-5">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="$root.loading"
                            >
                                @lang('Change')
                            </button>

                            <div v-if="mutated" class="ml-3 text-green-500">
                                @lang('Changed successfully!')
                            </div>
                        </div>
                    </form>
                <graphql-mutation>
            </div>
        </graphql>
    </div>
@endsection
