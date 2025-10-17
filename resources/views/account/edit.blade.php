@extends('rapidez::account.partials.layout')

@section('title', __('Edit account'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <div class="flex flex-col gap-y-0.5">
        <div class="bg rounded p-6 flex flex-col gap-y-2 sm:px-9 sm:pt-7 sm:pb-9">
            <h2 class="mb-2 text-lg font-bold">@lang('My addresses')</h2>
            @include('rapidez::account.partials.edit.address')
        </div>
        <div class="bg rounded p-6 flex flex-col gap-y-2 sm:px-9 sm:pt-7 sm:pb-9">
            <h2 class="mb-2 text-lg font-bold">@lang('Account information')</h2>
            @include('rapidez::account.partials.edit.account')
        </div>
        <div class="bg rounded p-6 flex flex-col gap-y-2 sm:px-9 sm:pt-7 sm:pb-9">
            <h2 class="mb-2 text-lg font-bold">@lang('Change email')</h2>
            @include('rapidez::account.partials.edit.email')
        </div>
        <div class="bg rounded p-6 flex flex-col gap-y-2 sm:px-9 sm:pt-7 sm:pb-9">
            <h2 class="mb-2 text-lg font-bold">@lang('Change password')</h2>
            @include('rapidez::account.partials.edit.password')
        </div>
        <x-rapidez::button.outline href="{{ route('account.overview') }}" class="self-start mt-4">
            @lang('Go back to account overview')
        </x-rapidez::button.outline>
    </div>
@endsection
