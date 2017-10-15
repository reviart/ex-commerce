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

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', 'ProductController@getIndex')->name('product.dashboard');

Route::prefix('user/')->group(function(){
  Route::group(['middleware' => ['guest']], function(){
    Route::get('signup', 'UserController@getSignup')->name('get.user.signup');
    Route::post('signup', 'UserController@postSignup')->name('post.user.signup');

    Route::get('signin', 'UserController@getSignin')->name('get.user.signin');
    Route::post('signin', 'UserController@postSignin')->name('post.user.signin');
  });
  Route::group(['middleware' => ['auth']], function(){
    Route::get('profile', 'UserController@getProfile')->name('get.user.profile');
    Route::get('logout', 'UserController@getLogout')->name('get.user.logout');
  });
});

Route::group(['middleware' => ['auth']], function(){
  Route::get('add-to-cart/{id}', 'ProductController@getAddToCart')->name('add.product.to.cart');
  Route::get('shopping-cart', 'ProductController@getCart')->name('get.shopping.cart');

  //checkout routes
  Route::get('checkout', 'ProductController@getCheckout')->name('get.checkout');
  Route::post('checkout', 'ProductController@postCheckout')->name('post.checkout');
  Route::get('print', 'ProductController@getPrint')->name('get.print');
  Route::get('printSuccess', 'ProductController@getSuccess')->name('get.finishOrder');

  //remove routes
  Route::get('reduce/{id}', 'ProductController@getReduceByOne')->name('product.reduceByOne');
  Route::get('remove/{id}', 'ProductController@getRemove')->name('product.remove');
});
