<?php

use Illuminate\Support\Facades\Route;

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

//--------------FRONTEND------------------------

Route::get('','frontend\IndexController@Index');
Route::get('about','frontend\IndexController@GetAbout');
Route::get('contact','frontend\IndexController@GetContact');
Route::get('{slug_cate}.html','frontend\IndexController@GetPrdCate');
Route::get('filter','frontend\IndexController@GetFilter');

//---------CART--------
Route::group(['prefix' => 'cart'], function () {
    Route::get('','frontend\CartController@GetCart');
    Route::get('add','frontend\CartController@AddCart');
    Route::get('update/{rowId}/{qty}','frontend\CartController@UpdateCart');
    Route::get('del/{rowId}','frontend\CartController@DelCart');
});

//--------PRODUCT---------
Route::group(['prefix' => 'product'], function () {
    Route::get('detail/{slug}','frontend\ProductController@GetDetail');
    Route::get('shop','frontend\ProductController@GetShop');
});
//-------CHECKOUT---------
Route::group(['prefix' => 'checkout'], function () {
    Route::get('','frontend\CheckoutController@GetCheckout');
    Route::post('','frontend\CheckoutController@PostCheckout');
    Route::get('complete/{order_id}','frontend\CheckOutController@GetComplete');
});




//------------------BACKEND---------------------------
Route::get('login', 'backend\LoginController@Login')->middleware('CheckLogout');
Route::post('login', 'backend\LoginController@PostLogin');


Route::group(['prefix' => 'admin','middleware'=>'CheckLogin'], function () {
    Route::get('', 'backend\IndexController@Index');
    Route::get('logout', 'backend\IndexController@Logout');

//------------PRODUCT---------
Route::group(['prefix' => 'product'], function () {
    Route::get('add', 'backend\ProductController@GetAddProduct');
    Route::post('add','Backend\ProductController@PostAddProduct');
    Route::get('edit/{id_product}', 'backend\ProductController@GetEditProduct');
    Route::post('edit/{id_product}', 'backend\ProductController@PostEditProduct');
    Route::get('del/{id_product}', 'backend\ProductController@DelProduct');
    Route::get('', 'backend\ProductController@GetListProduct');
});

//---------CATEGORY------------
Route::group(['prefix' => 'category'], function () {
    Route::get('', 'backend\CategoryController@GetCategory');
    Route::post('', 'backend\CategoryController@PostCategory');
    Route::get('edit/{id_cate}', 'backend\CategoryController@GetEditCategory');
    Route::post('edit/{id_cate}', 'backend\CategoryController@PostEditCategory');
    Route::get('del/{id_cate}','backend\CategoryController@DeleteCategory');
});

//---------USER--------
Route::group(['prefix' => 'user'], function () {
    Route::get('add', 'backend\UserController@GetAddUser');
    Route::post('add', 'backend\UserController@PostAddUser');
    Route::get('edit/{id}', 'backend\UserController@GetEditUser');
    Route::post('edit/{id}', 'backend\UserController@PostEditUser');
    Route::get('', 'backend\UserController@GetListUser');
    Route::get('del/{id}', 'backend\UserController@DelUser');
});

//-------ORDER--------
Route::group(['prefix' => 'order'], function () {
    Route::get('detail/{order_id}', 'backend\OrderController@GetDetailOrder');
    Route::get('', 'backend\OrderController@GetOrder');
    Route::get('paid/{order_id}','Backend\OrderController@paid');
    Route::get('processed', 'backend\OrderController@GetProcessed');
});
});








