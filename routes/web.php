<?php

Route::middleware('web')->group(function () {
    Route::view('login', 'rapidez::account.login');
    Route::view('register', 'rapidez::account.register');
    Route::view('account', 'rapidez::account.overview');
    Route::view('account/edit', 'rapidez::account.edit');
    Route::view('account/orders', 'rapidez::account.orders');
    Route::view('account/order/{id}', 'rapidez::account.order');
    Route::view('account/addresses', 'rapidez::account.addresses');
    Route::view('account/address/new', 'rapidez::account.address-new');
    Route::view('account/address/{id}', 'rapidez::account.address-edit');
});
