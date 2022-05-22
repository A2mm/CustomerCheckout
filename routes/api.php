<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    
    // start items routes
    Route::group(['namespace' => 'Api\V1\Items', 'as' => 'api.'], function(){
	    Route::get('/store/items', 'ItemApiController@fetch_items')->name('items.all');
    });
    // end items routes

   
    // start cart routes
    Route::group(['namespace' => 'Api\V1\Cart', 'as' => 'api.'], function(){
	    Route::post('/add/to/cart', 'CartApiController@add_cart')->name('cart.add_cart');
	    Route::post('/remove/from/cart', 'CartApiController@remove_from_cart')->name('cart.remove_from_cart');
	    Route::get('/show/cart', 'CartApiController@show_cart')->name('cart.show_cart');
    });
    // end cart routes

   
    // start payment/transaction routes
    Route::group(['namespace' => 'Api\V1\Payment', 'as' => 'api.'], function(){
	    Route::post('/place/transaction', 'PaymentApiController@place_transaction')->name('payment.place_transaction');
    });
   
    // end payment/transaction routes

});
