<?php
            Route::any('chart', 'WelcomeController@chart')->name('chart');
Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'WelcomeController@index')->name('index');
            ///charts
            Route::any('chart', 'WelcomeController@chart')->name('chart');

            /////////////
            Route::post('logout', 'RegisterController@logout')->name('logout');
            Route::get('forgetpass', 'RegisterController@forgetpass')->name('forgetpass');
            Route::post('saveemailadmin', 'RegisterController@saveemailadmin')->name('saveemailadmin');
            //category routes
            Route::resource('categories', 'CategoryController')->except(['show']);
            //ingots routes
            Route::resource('ingots', 'IngotsController')->except(['show']);
            //fees_ingots routes
            Route::resource('fees_caches', 'FeesCachesController')->except(['show']);
            //coins routes
            Route::resource('coins', 'CoinsController')->except(['show']);
            //fees_ingots routes
            Route::resource('coins_fees', 'CoinsfeesController')->except(['show']);
            //product routes
            Route::resource('products', 'ProductController')->except(['show']);
            Route::get('getfeeschach','ProductController@getfeeschach')->name('product.getfeeschach');
            Route::get('getfeescoins','ProductController@getfeescoins')->name('product.getfeescoins');
            //client routes
            Route::resource('clients', 'ClientController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrderController')->except(['show']);
            //contacts routes
            Route::resource('contacts', 'ContactsController')->except(['show']);
            //confirmPayment routes
            Route::resource('confirmpayment', 'ClientPaymentController')->except(['show']);
            Route::any('destroy/{id}', 'ClientPaymentController@destroy')->name('confirmpayment.destroy');
            Route::any('approve/{id}', 'ClientPaymentController@approve')->name('confirmpayment.approve');
            
            Route::any('disapprove/{id}', 'ClientPaymentController@disapprove')->name('confirmpayment.disapprove');
            Route::any('get_datiles', 'ClientPaymentController@get_datiles');

            //confirmvirtual_gold routes
            Route::resource('virtual_gold', 'VirtualGoldController')->except(['show']);
            Route::any('destroy2/{id}', 'VirtualGoldController@destroy')->name('virtual_gold.destroy');
            Route::any('approve2/{id}', 'VirtualGoldController@approve')->name('virtual_gold.approve');

            //order routes
            Route::resource('orders', 'OrderController');
            Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');

            ////////////bank details
            Route::resource('banks', 'BankDetailsController');

            //confirm transfer wallet routes
            Route::resource('wallet', 'WalletController')->except(['show']);
            Route::any('destroywallet/{id}', 'WalletController@destroy')->name('wallet.destroy');
            Route::any('walletapprove/{id}', 'WalletController@approve')->name('wallet.approve');
                //confirm withdrow wallet routes
                Route::resource('withdrowwallet', 'WithdrowWalletController')->except(['show']);
                Route::any('destroywithdrowwallet/{id}', 'WithdrowWalletController@destroy')->name('withdrowwallet.destroy');
                Route::any('withdrowwalletapprove/{id}', 'WithdrowWalletController@approve')->name('withdrowwallet.approve');

            //confirm shippingingots  routes
            Route::resource('shippingingots', 'ShippingApprovalController')->except(['show']);
            Route::any('destroyshippingingots/{id}', 'ShippingApprovalController@destroy')->name('shippingingots.destroy');
            Route::any('shippingingotsapprove/{id}', 'ShippingApprovalController@approve')->name('shippingingots.approve');
            ////////////add shippingcost
            Route::resource('shippingcost', 'ShippingcostController');
            //user routes

            ////////////add points//////////////////////
            Route::resource('points', 'PointsController');
             ////////////gifts//////////////////////
            Route::resource('gifts', 'GiftsController');
              ////////////contacts_info//////////////////////
              Route::resource('contacts_info', 'ContactsinfoController');
               ////////////aboutus//////////////////////aboutus
               Route::resource('aboutus', 'AboutusController');
              ////////////giftsrequest//////////////////////
              Route::resource('giftsrequest', 'GiftsRequestController');
              Route::any('giftsrequest/{id}', 'GiftsRequestController@approve')->name('giftsrequest.approve');
              Route::any('giftsrequestdestroy/{id}', 'GiftsRequestController@destroy')->name('giftsrequest.destroy');
            /////////////////user routes////
            Route::resource('users', 'UserController')->except(['show']);
            
        }); //end of dashboard routes
    }
);
