<?php

use Illuminate\Http\Request;

Route::middleware('web')->group(function () {
    // Magento_Customer
    Route::get('customer/address/edit/id/{addressId}', function ($addressId) {
        return to_route('account.address', ['id' => $addressId], 301);
    });
    Route::permanentRedirect('customer/address', '/account/addresses');
    Route::permanentRedirect('customer/address/index', '/account/addresses');
    Route::permanentRedirect('customer/address/new', '/account/address/new');
    Route::permanentRedirect('customer/account/create', '/register');
    Route::permanentRedirect('customer/account/edit', '/account/edit');
    Route::permanentRedirect('customer/account', '/account');
    Route::permanentRedirect('customer/account/index', '/account');
    Route::permanentRedirect('customer/account/login', '/login');
    Route::permanentRedirect('customer/account/forgotpassword', '/forgotpassword');
    Route::get('customer/account/createpassword', function (Request $request) {
        return redirect(str_replace('/customer/account/createpassword', '/resetpassword', $request->fullUrl()));
    });

    // Magento_Sales
    Route::permanentRedirect('sales/order/history', '/account/orders');
    Route::get('sales/order/view/order_id/{orderId}', function ($orderId) {
        return to_route('account.order', ['id' => $orderId], 301);
    });
});
