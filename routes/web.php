<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\ApplicationController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CustomertypeController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WebproductController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\QuoteController;
use App\Http\Controllers\Frontend\WebNewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 * 
 * Route::get('/', function () {
    return view('welcome');
});
*/



Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
        

});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');

//ADMIN ROUTES
Route::group(['prefix'=> 'admin', 'middleware'=>['auth:sanctum,admin', 'verified']], function(){

    Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile', [AdminProfileController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::post('/passwordupdate', [AdminProfileController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    //Admin Vendor All Routes
    Route::group(['prefix'=> 'vendor'], function(){
        Route::get('/lists', [VendorController::class, 'vendorlist'])->name('allvendors');
        Route::post('/add', [VendorController::class, 'addvendor'])->name('addvendor');
        Route::any('/edit/{id}', [VendorController::class, 'editvendor'])->name('editvendor');
        Route::any('/update/{id}', [VendorController::class, 'updatevendor'])->name('updatevendor');
        Route::any('/delete/{id}', [VendorController::class, 'deletevendor'])->name('deletevendor');
    });
    
    Route::group(['prefix'=> 'category'], function(){
        Route::get('/lists', [CategoryController::class, 'categorylist'])->name('allcategory');
        Route::get('/add', [CategoryController::class, 'addcategory'])->name('addcategory');
        Route::post('/store', [CategoryController::class, 'insertcategory'])->name('insertcategory');
        Route::any('/edit/{id}', [CategoryController::class, 'editcategory'])->name('editcategory');
        Route::any('/update/{id}', [CategoryController::class, 'updatecategory'])->name('updatecategory');
        Route::any('/delete/{id}', [CategoryController::class, 'deletecategory'])->name('deletecategory');
        Route::get('/checkcategoryslug', [CategoryController::class, 'checkcategoryslug'])->name('checkcategoryslug');
    });
    
    Route::group(['prefix'=> 'product'], function(){
        Route::get('/lists', [ProductController::class, 'productlist'])->name('allproduct');
        Route::get('/add', [ProductController::class, 'addproduct'])->name('addproduct');
        Route::post('/store', [ProductController::class, 'storeproduct'])->name('storeproduct');
        Route::any('/edit/{id}', [ProductController::class, 'editproduct'])->name('editproduct');
        Route::any('/update/{id}', [ProductController::class, 'updateproduct'])->name('updateproduct');
        Route::any('/delete/{id}', [ProductController::class, 'deleteproduct'])->name('deleteproduct');
        Route::get('/checkproductslug', [ProductController::class, 'checkproductslug'])->name('checkproductslug');
        Route::get('/exportproducts', [ProductController::class, 'exportproducts'])->name('exportproducts');
        Route::any('/import-pricing/', [ProductController::class, 'productpricingimport'])->name('productpricingimport');
        Route::any('/import-pricing-process/', [ProductController::class, 'productpricingimportprocess'])->name('productpricingimportprocess');
    });
    
    Route::group(['prefix'=> 'application'], function(){
        Route::get('/lists', [ApplicationController::class, 'applicationlist'])->name('allapplications');
        Route::post('/add', [ApplicationController::class, 'addapplication'])->name('addapplication');
        Route::any('/edit/{id}', [ApplicationController::class, 'editapplication'])->name('editapplication');
        Route::any('/update/{id}', [ApplicationController::class, 'updateapplication'])->name('updateapplication');
        Route::any('/delete/{id}', [ApplicationController::class, 'deleteapplication'])->name('deleteapplication');
        Route::get('/checkapplicationslug', [ApplicationController::class, 'checkapplicationslug'])->name('checkapplicationslug');
    });
    
    Route::group(['prefix'=> 'customertype'], function(){
        Route::get('/lists', [CustomertypeController::class, 'customertypelist'])->name('allcustomertypes');
        Route::post('/add', [CustomertypeController::class, 'addcustomertype'])->name('addcustomertype');
        Route::any('/edit/{id}', [CustomertypeController::class, 'editcustomertype'])->name('editcustomertype');
        Route::any('/update/{id}', [CustomertypeController::class, 'updatecustomertype'])->name('updatecustomertype');
        Route::any('/delete/{id}', [CustomertypeController::class, 'deletecustomertype'])->name('deletecustomertype');
    });
    
    Route::group(['prefix'=> 'customer'], function(){
        Route::get('/lists', [CustomerController::class, 'customerlist'])->name('allcustomers');
        Route::get('/add', [CustomerController::class, 'addcustomer'])->name('addcustomer');
        Route::post('/store', [CustomerController::class, 'storecustomer'])->name('storecustomer');
        Route::any('/edit/{id}', [CustomerController::class, 'editcustomer'])->name('editcustomer');
        Route::any('/update/{id}', [CustomerController::class, 'updatecustomer'])->name('updatecustomer');
        Route::any('/delete/{id}', [CustomerController::class, 'deletecustomer'])->name('deletecustomer');
        Route::any('/customer-import/', [CustomerController::class, 'customerimport'])->name('customerimport');
        Route::any('/customer-import-process/', [CustomerController::class, 'customerimportprocess'])->name('customerimportprocess');
        Route::any('/customerpricing/{id}', [CustomerController::class, 'customerpricing'])->name('customerpricing');
        Route::any('/updatecustomerpricing/{id}', [CustomerController::class, 'updatecustomerpricing'])->name('updatecustomerpricing');
        Route::any('/import-customerpricing/', [CustomerController::class, 'customerpricingimport'])->name('customerpricingimport');
        Route::any('/import-customerpricing-process/', [CustomerController::class, 'customerpricingimportprocess'])->name('customerpricingimportprocess');

    });
    Route::get('/orders', [OrderController::class, 'myorders'])->name('adminorders');
    Route::get('/orderdetail/{id}', [OrderController::class, 'orderdetail'])->name('adminorderdetail');
    Route::get('/order-invoice/{id}', [OrderController::class, 'orderInvoice'])->name('admin.invoice');
    Route::post('/orderupdate/{id}', [OrderController::class, 'orderupdate'])->name('adminorderupdate');
    Route::post('/admin-order-invoice-type-update/{id}', [OrderController::class, 'adminOrderInvoiceTypeUpdate'])->name('adminOrderInvoiceTypeUpdate');
    Route::post('/updatetrackingdetails/{id}', [OrderController::class, 'updatetrackingdetails'])->name('updatetrackingdetails');
    Route::get('/myquotes', [OrderController::class, 'myquotes'])->name('adminmyquotes');
    Route::get('/quotedetail/{id}', [OrderController::class, 'myquotedetail'])->name('adminmyquotedetail');
    Route::any('/deletequote/{id}', [OrderController::class, 'deletequote'])->name('deletequote');
    
    Route::group(['prefix'=> 'news'], function(){
        Route::get('/lists', [NewsController::class, 'newslist'])->name('allnews');
        Route::get('/add', [NewsController::class, 'addnews'])->name('addnews');
        Route::post('/store', [NewsController::class, 'storenews'])->name('storenews');
        Route::any('/edit/{id}', [NewsController::class, 'editnews'])->name('editnews');
        Route::any('/update/{id}', [NewsController::class, 'updatenews'])->name('updatenews');
        Route::any('/delete/{id}', [NewsController::class, 'deletenews'])->name('deletenews');
        Route::get('/checknewsslug', [NewsController::class, 'checknewsslug'])->name('checknewsslug');
    });
    
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:sanctum,admin', 'verified']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/', [IndexController::class, 'index'])->name('homepage');
Route::post('/ajaxlogin', [UserController::class, 'ajaxlogin'])->name('ajaxlogin');
Route::post('/customlogin', [UserController::class, 'customlogin'])->name('customlogin');

Route::post('/subscribe', [UserController::class, 'subscribe'])->name('subscribe');
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/category/{slug}', [WebproductController::class, 'categorydetail'])->name('categorydetail');
Route::get('/product/{slug}', [WebproductController::class, 'productdetail'])->name('productdetail');
Route::get('/application/{slug}', [IndexController::class, 'applicationdetail'])->name('applicationdetail');
Route::get('/products', [IndexController::class, 'allproductscategory'])->name('allproductscategory');

Route::get('/productlist', [App\Http\Controllers\HomeController::class, 'productlist'])->name('home');
Route::get('/product-detail', [App\Http\Controllers\HomeController::class, 'productdetail'])->name('home');

/// Product Search Route 
Route::any('/search', [IndexController::class, 'ProductSearch'])->name('product.search');
Route::any('/store-search', [IndexController::class, 'StoreProductSearch'])->name('storesearch');
Route::post('/ajaxregister', [UserController::class, 'register'])->name('ajaxregister');
Route::post('/customregister', [UserController::class, 'customregister'])->name('customregister');

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart'])->name('addtocart');
Route::post('/cart/updatecart', [CartController::class, 'updatecart'])->name('updatecart');
Route::get('/cart/removecartitem/{id}', [CartController::class, 'removecartitem'])->name('removecartitem');
Route::get('/cart/clearcart', [CartController::class, 'clearcart'])->name('clearcart');

// Get Data from mini cart
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);

Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Advance Search Routes 
Route::post('search-product', [IndexController::class, 'SearchProduct']);
Route::get('/cart', [CartController::class, 'GetCartProduct'])->name('cart');
Route::get('/checkout', [CheckoutController::class, 'checkoutdetail'])->name('checkout');
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkoutstore');
Route::post('/checkout-address/{id}', [CheckoutController::class, 'getCheckoutSingleAddress'])->name('get.checkout.single.address');
Route::post('/checkout-fetch-address/{id}', [CheckoutController::class, 'getCheckoutShippingAddress'])->name('get.checkout.shipping.address');
Route::post('/checkout-data/{id}', [CheckoutController::class, 'getCheckoutSingle'])->name('get.checkout.single');
Route::get('/about-us', function(){ return view('frontend.pages.about'); })->name('aboutus');
Route::get('/industrydemo', [IndexController::class, 'industrydemo'])->name('industry');
Route::get('/healthcaredemo', [IndexController::class, 'healthcaredemo'])->name('healthcare');
Route::get('/corporatedemo', function(){ return view('frontend.pages.corporate'); })->name('corporate');
Route::get('/financialdemo', function(){ return view('frontend.pages.financial'); })->name('financial');
Route::get('/governmentdemo', function(){ return view('frontend.pages.government'); })->name('government');
Route::get('/news', [WebNewsController::class, 'allnews'])->name('news');
Route::get('/news/{slug}', [WebNewsController::class, 'newsdetail'])->name('newsdetail');
Route::get('/contact-us', function(){ return view('frontend.pages.contactus'); })->name('contactus');
Route::post('/contactrequest', [IndexController::class, 'contactrequest'])->name('contactrequest');
Route::post('/ajaxcontactrequest', [IndexController::class, 'ajaxcontactrequest'])->name('ajaxcontactrequest');
Route::get('/thank-you', function(){ return view('frontend.pages.thankyou'); })->name('thankyou');
Route::get('/store',[IndexController::class, 'store'])->name('store');
Route::get('/demostore',[IndexController::class, 'demostore'])->name('demostore');
Route::get('/store/industry/{slug}',[IndexController::class, 'storeindustry'])->name('storeindustry');
Route::get('/store/products/{slug}',[IndexController::class, 'storecategory'])->name('storecategory');
Route::get('/service-support-maintenance', function(){ return view('frontend.pages.servicesupport'); })->name('servicesupport');

Route::middleware(['auth:sanctum,web', 'verified'])->group(function () {
Route::get('/shipping-address', function(){ return view('frontend.myaccount.shippingaddress'); })->name('shippingaddress');
Route::get('/billing-address', function(){ return view('frontend.myaccount.billingaddress'); })->name('billingaddress');
Route::get('/shipping-address', [UserController::class, 'CustomerShippingAddress'])->name('shippingaddress');
Route::post('/shipping-address', [UserController::class, 'CustomerShippingAddressUpdate'])->name('shippingaddress.update');
Route::get('/billing-address', [UserController::class, 'CustomerBillingAddress'])->name('billingaddress');
Route::post('/billing-address', [UserController::class, 'CustomerBillingAddressUpdate'])->name('billingaddress.update');
Route::get('/address', [UserController::class, 'CustomerAddress'])->name('addresses'); 
Route::get('/add-shipping-address', [UserController::class, 'AddShippingCustomerMoreAddress'])->name('add.shipping.more.addresses');
Route::post('/add-more-address', [UserController::class, 'CustomerMoreAddress'])->name('add.more.address');
Route::get('/edit-shipping-address', [UserController::class, 'editCustomerMoreAddress'])->name('edit.more.addresses');
Route::post('/update-address', [UserController::class, 'updateCustomerMoreAddress'])->name('update.more.addresses');
Route::get('/delete-more-address/{id}', [UserController::class, 'deleteCustomerMoreAddress'])->name('delete.more.addresses');
Route::get('/set-default-address/{id}', [UserController::class, 'setDefaultCustomerAddress'])->name('set.default.addresses');

Route::get('/orders', [UserController::class, 'myorders'])->name('orders');
Route::post('/upload-po', [UserController::class, 'uploadPo'])->name('uploadpo');
Route::post('/orders', [UserController::class, 'myorders'])->name('post_orders');
Route::get('/orderdetail/{id}', [UserController::class, 'orderdetail'])->name('orderdetail');
Route::get('/order-invoice/{id}', [UserController::class, 'invoice'])->name('invoice');
Route::get('/profile', function(){ return view('frontend.myaccount.profile'); })->name('profile');
Route::get('/profile', [UserController::class, 'CustomerProfile'])->name('profile');
Route::post('/profile', [UserController::class, 'CustomerProfileUpdate'])->name('profile.update');
Route::get('/myquotes', [UserController::class, 'myquotes'])->name('myquotes');
Route::get('/quotedetail/{id}', [UserController::class, 'myquotedetail'])->name('myquotedetail');
Route::get('/paymentsetting', [UserController::class, 'paymentsetting'])->name('paymentsetting');
Route::post('/addpaymentsetting', [UserController::class, 'addpaymentsetting'])->name('addpaymentsetting');
Route::get('/deletepayment/{id}', [UserController::class, 'deletepayment'])->name('deletepayment');
Route::get('/edit-payment/{id}', [UserController::class, 'editpayment'])->name('editpayment');
Route::post('/update-payment', [UserController::class, 'updatepayment'])->name('updatepayment');
Route::get('/security', [UserController::class, 'security'])->name('security');
Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.user.password');

});
Route::get('/page404', function(){ return view('frontend.page404'); })->name('page404');

// Add to Quote Frontend
Route::post('/quote/data/store/{id}', [QuoteController::class, 'AddToQuoteitem'])->name('addtoquote');
Route::post('/quote/updatequote', [QuoteController::class, 'updatequoteitem'])->name('updatequote');
Route::get('/quote/removequoteitem/{id}', [QuoteController::class, 'removequoteitem'])->name('removequoteitem');
Route::get('/request-quote', [QuoteController::class, 'requestquotelist'])->name('requestquotelist');
Route::post('/request-quote', [QuoteController::class, 'requestquote'])->name('requestquote');
Route::get('/quote-count', [QuoteController::class, 'myquotecount'])->name('myquotecount');

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/clear-cache', function() {
    
   // Artisan::call('key:generate');
   // Artisan::call('storage:link');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
   
    
    return "Cache is cleared";
});
Route::get('/orderemail/{id}', [CheckoutController::class, 'orderemail'])->name('orderemail');
Route::get('/sitemap.xml', [IndexController::class, 'sitemap']);