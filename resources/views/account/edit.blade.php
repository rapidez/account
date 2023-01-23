@extends('rapidez::account.partials.layout')

@section('title', __('Edit account'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('account-content')
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <div>
            <h2 class="mb-2 text-2xl font-bold">@lang('Account information')</h2>
            @include('rapidez::account.partials.edit.account')
        </div>
        <div>
            <h2 class="mb-2 text-2xl font-bold">@lang('Change password')</h2>
            @include('rapidez::account.partials.edit.password')
        </div>
        <div>
            <h2 class="mb-2 text-2xl font-bold">@lang('Change email')</h2>
            @include('rapidez::account.partials.edit.email')
        </div>
    </div>
@endsection
