<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;

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


Auth::routes();
Route::get('/home', 'UserController@index')->name('home');
Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');


Route::get('/', 'UserController@index');
// Route::get('/getProductByCategory/{Category}', 'UserController@getProductByCategory');
Route::get('/getProductByCategory', 'UserController@getProductByCategory');

Route::get('/categoryPage/{id}', 'UserController@categoryPage');
Route::get('/SubCategoryPage/{id}', 'UserController@SubCategoryPage');
// customer details product
Route::get('/detailsProduct/{id}', 'UserController@detailsProduct')->middleware('auth');
// shipping page
// Route::get('/shipping/{id}', 'UserController@shippingPage');


// category Controller

Route::get('/category', 'CategoryController@index');
Route::post('/category', 'CategoryController@store');
Route::get('/allcategory', 'CategoryController@allcategory');
Route::post('/categoryDelete', 'CategoryController@categoryDelete');

Route::get('/catbyproduct/', 'CategoryController@catbyproduct');

// change status
Route::post('/categoryStatus','StatusController@categoryStatus');

// subcategory
Route::get('/subcategory', 'SubCategoryController@index');
Route::post('/subcategory', 'SubCategoryController@store');
Route::get('/allsubcategory', 'SubCategoryController@allsubcategory');
Route::post('/subcategoryDelete', 'SubCategoryController@subcategoryDelete');
Route::post('/subcategoryStatus','SubCategoryController@subcategoryStatus');
Route::post('/subCatDetails','SubCategoryController@subCatDetails');
Route::post('/updateSubCat','SubCategoryController@updateSubCat');


// Brand
Route::get('/brands', 'BrandController@index');
Route::post('/brands', 'BrandController@store');
Route::get('/allbrands', 'BrandController@allbrands');
Route::post('/brandsDelete', 'BrandController@brandsDelete');
Route::post('/brandsStatus','BrandController@brandsStatus');
Route::post('/brandsDetails','BrandController@brandsDetails');
Route::post('/updateBrand','BrandController@updateBrand');


// color
Route::get('/colors', 'ColorController@index');
Route::post('/colors', 'ColorController@store');
Route::get('/allcolors', 'ColorController@allcolors');
Route::post('/colorsDelete', 'ColorController@colorsDelete');
Route::post('/colorsStatus','ColorController@colorsStatus');
Route::post('/colorsDetails','ColorController@colorsDetails');
Route::post('/updateColor','ColorController@updateColor');


// size
Route::get('/size', 'SizeController@index');
Route::post('/size', 'SizeController@store');
Route::get('/allsize', 'SizeController@allsize');
Route::post('/sizeDelete', 'SizeController@sizeDelete');
Route::post('/sizeStatus','SizeController@sizeStatus');
Route::post('/sizeDetails','SizeController@sizeDetails');
Route::post('/updateSize','SizeController@updateSize');

Route::get("addmore","SizeController@addMore");
Route::post("addmore","SizeController@addMorePost");

// units
Route::get('/units', 'UnitController@index');
Route::post('/units', 'UnitController@store');
Route::get('/allunits', 'UnitController@allunits');
Route::post('/unitsDelete', 'UnitController@unitsDelete');
Route::post('/unitsStatus','UnitController@unitsStatus');
Route::post('/unitsDetails','UnitController@unitsDetails');
Route::post('/updateUnit','UnitController@updateUnit');


// Product Controller

Route::get('/products', 'ProductController@index');
Route::post('/products', 'ProductController@store');
Route::get('/allproducts', 'ProductController@allproducts');
Route::post('/productDelete', 'ProductController@productDelete');


// add to cart
Route::post('/addToCart','CartController@addToCartProduct')->middleware('auth');

// cart page route

Route::get('/shipping-details','UserController@ShippingCartDetailsPage')->middleware('auth');
Route::get('/cartItems','CartController@ShippingCartDetails')->middleware('auth');
Route::post('/cartIncrement','CartController@cartIncrement')->middleware('auth');
Route::post('/cartDecrement','CartController@cartDecrement')->middleware('auth');
Route::post('/cartDelete','CartController@cartDelete')->middleware('auth');
Route::get('/allCartItem','CartController@allCartItem');
Route::get('/subtotal','CartController@subtotal')->middleware('auth');


// cart page route

// Route::get('/checkout','UserController@checkoutPage')->middleware('auth');

// Shipping
Route::resource('/shipping','ShippingController');


// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/checkout', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


