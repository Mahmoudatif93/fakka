<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

       Route::prefix('fakka')->name('fakka.')->middleware(['webauth'])->group(function () {


           });
                    /////////////////////////home///////////
                   Route::prefix('')->name('fakka.')->group(function () {
                    Route::get('/', 'WelcomeController@index')->name('index');
                    Route::get('home-to-cart/{id}','WelcomeController@getAddToCart')->name('home.addToCart');
                    Route::get('gold_price','WelcomeController@gold_price')->name('home.gold_price');

                    Route::get('about_us','WelcomeController@about_us')->name('about_us');
                    //product routes//////////////////////////////////
                    Route::resource('products', 'ProductController')->except(['show']);
                    Route::any('postdate', 'ProductController@postDate');
                   Route::get('productdetails/{id}','ProductController@productdetails')->name('productdetails');
                /////client routes//////////////////////////////////
                Route::resource('client', 'RegisterController')->except(['show']);
                Route::get('login', 'RegisterController@login')->name('login');
                Route::post('postlogin', 'RegisterController@postlogin')->name('postlogin');
                Route::post('logout', 'RegisterController@logout')->name('logout');
                Route::get('logout2', 'RegisterController@logout')->name('logout2');
                Route::get('resetpassword', 'RegisterController@resetpassword')->name('resetpassword');
                Route::post('resetnewpassword', 'RegisterController@forgetpassword')->name('resetnewpassword');
                Route::get('makenewpassword/{user}', 'RegisterController@newpassword')->name('makenewpassword');
                Route::post('updatenewpass', 'RegisterController@updatenewpass')->name('updatenewpass');
              
              Route::any('savesmscode', 'RegisterController@savesmscode')->middleware("cors");
              Route::any('checkcode', 'RegisterController@checkcode');
              Route::any('checkacountexist', 'RegisterController@checkacountexist');
              
              

              
                /////////////////////shopping cart/////////////////////
                Route::get('newproduct', 'ProductController@index')->name('product.index');
                Route::get('add-to-cart/{id}','ProductController@getAddToCart')->name('product.addToCart');


                Route::get('shopping-cart','ProductController@getCart')->name('product.shoppingCart');
                Route::get('reduce/{id}','ProductController@getReduceByOne')->name('product.reduceByOne');
                Route::get('add/{id}','ProductController@getAddByOne')->name('product.addByOne');
                Route::get('remove/{id}','ProductController@getRemoveItem')->name('product.remove');
                    /////////////////////////add, reduce and delete in database when make login///
                Route::get('addsave/{id}','ProductController@addsaveone')->name('product.addsave');
                Route::get('removeonesave/{id}','ProductController@removeonesave')->name('product.removeonesave');
                Route::get('removeallsave/{id}','ProductController@removeallsave')->name('product.removeallsave');

                ///////////////////////////add and remove one in product details

                Route::get('getAddToCartdetails/{id}','ProductController@getAddToCartdetails')->name('getAddToCartdetails');
                ////////////////////confirm payment///
                Route::resource('confirm_payment', 'ConfirmPaymentController')->except(['show'])->middleware(['webauth']);
                Route::get('remove_confirm/{id}','ConfirmPaymentController@getRemoveItem')->name('remove.confirm');
                ////////////////////////////////
                //////////////contactus////////////////////////
                Route::resource('contactus', 'ContactUsController')->except(['show']);
                //////////////////////////////////////////////////
                  //////////////virtual gold/////////////////////
                  Route::resource('virtualgold', 'VirtualGoldController')->except(['show'])->middleware(['webauth']);
                  Route::any('Virtualdetails', 'VirtualGoldController@Virtualdetails');
                  Route::any('getVirtualdetails', 'VirtualGoldController@getVirtualdetails');
                  Route::any('Virtualpaynow', 'VirtualGoldController@Virtualpaynow');
                  Route::any('checkpassword', 'VirtualGoldController@checkpassword');
                  //////////////////////////////////////
                    //////////////profile/////////////////////
                    Route::resource('profile', 'ProfileController')->except(['show'])->middleware(['webauth']);
                    Route::get('newpassword/{id}', 'ProfileController@newpassword')->name('newpassword')->middleware(['webauth']);
                    Route::get('update_address/{id}','ProfileController@update_address')->name('update_address');
                    Route::get('delete_image/{id}','ProfileController@delete_image')->name('delete_image');
                    Route::get('delete_iban/{id}','ProfileController@delete_iban')->name('delete_iban');
                    Route::post('ajax-image-upload','ProfileController@store')->name('image.ajax.store');
                    Route::get('certifcates/{id}', 'ProfileController@certifcates')->name('certifcates');
                    Route::get('printcertifcates/{id}', 'ProfileController@printcertifcates')->name('printcertifcates');
                    Route::get('downloadcertifcates/{id}', 'ProfileController@downloadPDF')->name('downloadcertifcates');

                    Route::post('slfe-image-upload','ProfileController@slfestore')->name('image.slfestore');
                    Route::get('delete_selfeimage/{id}','ProfileController@delete_selfeimage')->name('delete_selfeimage');
                    //////////////////////////virtual physical print/////////////////

                    Route::get('physical_certifcates/{id}', 'ProfileController@physical_certifcates')->name('physical_certifcates');
                    Route::get('physical_printcertifcates/{id}', 'ProfileController@physical_printcertifcates')->name('physical_printcertifcates');
                    Route::get('physical_downloadPDF/{id}', 'ProfileController@physical_downloadPDF')->name('physical_downloadPDF');


                    ///////////////////////////profile virtual balance//////
                    Route::get('saveredeemgold','ProfileController@saveredeemgold')->name('saveredeemgold');
                    Route::get('savereclientiban','ProfileController@savereclientiban')->name('savereclientiban');
                    Route::get('saveredeemmoney','ProfileController@saveredeemmoney')->name('saveredeemmoney');
                    Route::get('confirmpass','ProfileController@confirmpass')->name('confirmpass');
                    Route::get('checkwaletredeme','ProfileController@checkwaletredeme')->name('checkwaletredeme');
                    Route::get('checkamountredeemgold','ProfileController@checkamountredeemgold')->name('checkamountredeemgold');

                    ////////////////////////////////////profile physical balance//////////////////
                    Route::get('savephysicalredeemmoney','ProfileController@savephysicalredeemmoney')->name('savephysicalredeemmoney');
                    Route::get('saveshippingcost','ProfileController@saveshippingcost')->name('saveshippingcost');

                    /////////////////////////////////////////wallet///////////////////
                    Route::get('savewalletmoney','ProfileController@savewalletmoney')->name('savewalletmoney');
                    Route::get('withdrowwalletmoney','ProfileController@withdrowwalletmoney')->name('withdrowwalletmoney');
                    Route::get('checkwithdrowamount','ProfileController@checkwithdrowamount')->name('checkwithdrowamount');
                    Route::get('getaddiban','ProfileController@getaddiban')->name('wallet.getaddiban');
                    Route::get('getwithdrwiban','ProfileController@getwithdrwiban')->name('wallet.getwithdrwiban');
                     //////////////////////////////////////points//////////////////
                     Route::get('redeempoints','ProfileController@redeempoints')->name('redeempoints');
                     Route::get('redeemgift','ProfileController@redeemgift')->name('redeemgift');

                    //////////////////////////////////////scrapeData (gold price)
                    Route::get('gold_price','ScrapeController@gold_price')->name('gold_price');
                    Route::get('gold_us_price','ScrapeController@gold_us_price')->name('gold_us_price');
                    ///////////////////termcondtions/////////////////////////
                    Route::resource('termcondtions', 'TermsController')->except(['show']);
                     /////////////////////////policy///////////////////
                     Route::get('policy', 'TermsController@policy')->name('policy');

                });



    });


