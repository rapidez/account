<?php

Route::middleware('web')->group(function () {
    Route::view('login', 'rapidez::account.login');
    Route::view('account', 'rapidez::account.overview');
    Route::view('account/edit', 'rapidez::account.edit');
    Route::view('account/orders', 'rapidez::account.orders');
    Route::view('account/order/{id}', 'rapidez::account.order');
    Route::view('account/addresses', 'rapidez::account.addresses');
});
