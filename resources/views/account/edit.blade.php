@extends('rapidez::account.partials.layout')

@section('title', __('Edit account'))

@section('account-content')
    <div class="container mx-auto">
        <div class="sm:flex sm:space-x-10">
            <div class="sm:w-1/3">
                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Account information')</h2>
                @include('rapidez::account.partials.edit.account')
            </div>
            <div class="sm:w-1/3">
                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Change password')</h2>
                @include('rapidez::account.partials.edit.password')
            </div>
            <div class="sm:w-1/3">
                <h2 class="font-bold text-2xl mt-5 mb-3">@lang('Change email')</h2>
                @include('rapidez::account.partials.edit.email')
            </div>
        </div>
    </div>
@endsection
