<?php

Route::middleware('web')->group(function () {
    Route::view('login', 'rapidez::account.login')->name('account.login');
    Route::view('register', 'rapidez::account.register')->name('account.register');
    Route::view('forgotpassword', 'rapidez::account.forgotpassword')->name('account.forgotpassword');
    Route::view('resetpassword', 'rapidez::account.resetpassword')->name('account.resetpassword');

    Route::view('account', 'rapidez::account.overview')->name('account.overview');
    Route::view('account/edit', 'rapidez::account.edit')->name('account.edit');
    Route::view('account/orders', 'rapidez::account.orders')->name('account.orders');
    Route::view('account/order/{id}', 'rapidez::account.order')->name('account.order');
    Route::view('account/address/new', 'rapidez::account.address-new')->name('account.address.create');
    Route::view('account/address/{id}', 'rapidez::account.address-edit')->name('account.address');
});
