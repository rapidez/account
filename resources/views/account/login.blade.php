@extends('rapidez::layouts.app')

@section('title', __('Login'))

@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    @include('rapidez::account.partials.login')
@endsection
