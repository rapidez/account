<?php

use Illuminate\Http\Request;

Route::middleware('web')->group(function () {
    // Magento_Customer
    Route::get('customer/address/edit/id/{addressId}', function ($addressId) {
        return to_route('account.address', ['id' => $addressId], 301);
    });
    Route::permanentRedirect('customer/address', route('account.addresses'));
    Route::permanentRedirect('customer/address/index', route('account.addresses'));
    Route::permanentRedirect('customer/address/new', route('account.address.create'));
    Route::permanentRedirect('customer/account/create', route('account.register'));
    Route::permanentRedirect('customer/account/edit', route('account.edit'));
    Route::permanentRedirect('customer/account', route('account.overview'));
    Route::permanentRedirect('customer/account/index', route('account.overview'));
    Route::permanentRedirect('customer/account/login', route('account.login'));
    Route::permanentRedirect('customer/account/forgotpassword', route('account.forgotpassword'));
    Route::get('customer/account/createpassword', function (Request $request) {
        return redirect(str_replace('/customer/account/createpassword', '/resetpassword', $request->fullUrl()));
    });

    // Magento_Sales
    Route::permanentRedirect('sales/order/history', route('account.orders'));
    Route::get('sales/order/view/order_id/{orderId}', function ($orderId) {
        return to_route('account.order', ['id' => $orderId], 301);
    });
});
