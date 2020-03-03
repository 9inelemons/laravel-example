<?php

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/getOrdersData', 'ApiController@getOrdersData');
    Route::post('/sendOrdersData', 'ApiController@sendOrdersData');

    Route::group(['middleware' => ['auth']], function() {
        Route::namespace('Owner')->prefix('owner')->name('owner.')->group(function () {

            Route::get('/index', 'OwnerController@index')->name('index');

            Route::prefix('prices')->name('prices.')->group(function () {

                Route::prefix('import')->name('import.')->group(function () {
                    Route::get('/', 'PricesController@importViewPage')->name('index');
                    Route::post('/upload', 'PricesController@import')->name('upload');
                });
                Route::post('/hide', 'PricesController@showOrHidePrice')->name('hide');
                Route::post('/destroy/', 'PricesController@destroy')->name('destroy');
                Route::get('/', 'PricesController@index')->name('index');
                Route::get('/prices/data', 'PricesController@pricesData')->name('data');
            });

            Route::prefix('items')->name('items.')->group(function () {
                Route::get('/{price}', 'PricesController@priceItemsTableView')->name('index');
                Route::get('/data/{price}', 'PricesController@priceItemsData')->name('data');
            });

        });

        Route::namespace('Orders')->prefix('orders')->name('orders.')->group(function () {

            Route::get('', 'OrdersController@index')->name('index');
            Route::get('/data', 'OrdersController@ordersData')->name('ordersData');
            Route::get('/order/{order}', 'OrdersController@itemsView')->name('itemsView');
            Route::get('/itemsData/{order}', 'OrdersController@itemsData')->name('itemsData');

            Route::prefix('new')->name('new.')->group(function () {
                Route::get('/', 'NewOrderController@index')->name('index');
                Route::get('/organizations', 'NewOrderController@organizationsData')->name('orgData');
                //Routes for prices Datatable
                Route::get('/pricestable/{user}', 'NewOrderController@pricesView')->name('pricesView');
                Route::get('/pricestable/data/{user}', 'NewOrderController@pricesData')->name('pricesData');
                //Routes for price items Datatable
                Route::get('/items/{price}', 'NewOrderController@itemsView')->name('itemsView');
                Route::get('/items/data/{price}', 'NewOrderController@itemsData')->name('itemsData');
                //Routes for add-to-cart-process
                Route::post('/add-to-cart', 'NewOrderController@addToCart')->name('addToCart');
                //Checkout routes
                Route::get('/checkout', 'NewOrderController@checkoutView')->name('checkout');
                Route::get('/checkout/data', 'NewOrderController@checkoutData')->name('checkoutData');
                Route::post('/checkout/delete', 'NewOrderController@checkoutDeleteItem')->name('cartDelete');
                Route::get('/checkout/confirm', 'NewOrderController@checkoutConfirmOrder')->name('confirmOrder');
                //Subtotal route
                Route::post('/subTotalData', 'NewOrderController@subTotalData')->name('subTotalData');
            });
        });
    });

