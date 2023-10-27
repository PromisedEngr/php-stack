<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\VendarController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CustomerServiceController;
use Illuminate\Support\Facades\Auth;


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

// Common Url
Route::POST('/fetchOptionDropDown',[CommonController::class,'fetchOptionDropDown']);
Route::post('/verify-mobile',[CommonController::class,'verifyMobile']);
Route::post('/check-otp',[CommonController::class,'checkOtp']);
// Common Url

Route::get('/',[FrontController::class,'index'])->name('home');
Route::get('/about',[FrontController::class,'about'])->name('about');
Route::get('/contact',[FrontController::class,'contact'])->name('contact');

// Customer Login
Route::get('/registration',[CustomerController::class,'create_register'])->name('customer.register');
Route::post('/customer_registration',[CustomerController::class,'customer_registration'])->name('customer.registration');
Route::get('/customer_login',[CustomerController::class,'customer_login'])->name('customerloginpage');
Route::post('/customerslogin',[CustomerController::class,'submitCustomerlogin']);
Route::get('/customer_forgetpassword',[CustomerController::class,'customerForgetpassword']);
Route::post('/customerforgetpassword',[CustomerController::class,'customerforgetpasswordSubmit']);
// Added by Rana Ghosh 01-03-2022
Route::post('/customer-mobile-verify',[CustomerController::class,'customerMobileVerify']);
Route::post('/customer-login-submit',[CustomerController::class,'customerFinalLoginSubmit']);
Route::post('/customer-forget-password-submit',[CustomerController::class,'customerforgetpasswordSubmitNew']);

// Customer route
Route::group( ['middleware' => ['customerLogin:customer'] ],function(){
    Route::get('/customerdashboard',[CustomerController::class,'customerdashboard']);
    Route::get('/customer/logout', [CustomerController::class, 'logout']);
    Route::get('/customer/customer_profile', [CustomerController::class, 'customer_profile']);
    Route::post('customer/update_profile',[CustomerController::class,'customerUpdateProfile']);
    Route::post('/customer/changepassword', [CustomerController::class, 'changePassword']);
    Route::get('/customer/findvenderservices',[FrontController::class,'findvenderservices']);
    Route::POST('/fetch_services',[FrontController::class,'fetch_services']);
    Route::get('/service_details',[FrontController::class,'serviceDetails']);
    Route::POST('/vendorListing',[FrontController::class,'vendorListing']);
    Route::get('/customer/chatwithvendor',[FrontController::class,'chatwithvendor']);
    Route::POST('/customer/submitTask',[FrontController::class,'submitTask']);
    Route::get('/customer/mypostedtask',[CustomerServiceController::class,'mypostedtask']);
    Route::POST('/customer/viewfulltask',[CustomerServiceController::class,'viewfulltaskDetails']);
    Route::POST('/customer/search_service',[CustomerServiceController::class,'search_service']);
});

// Vendor
    Route::get('/create_vendor',[VendarController::class,'create_register'])->name('vendor.register');
    Route::post('/vendor_registration',[VendarController::class,'vendor_registration'])->name('vendor.registration');
    Route::get('/vendor_login',[VendarController::class,'vendor_login'])->name('vendorloginpage');
    Route::post('/vendorLogin',[VendarController::class,'vendorLogin']);
    Route::post('/vendorFinalLogin',[VendarController::class,'submitLoginCode']);
    Route::get('/vendor_forgetpassword',[VendarController::class,'vendorForgetpassword']);
    Route::post('/vendorforgetpassword',[VendarController::class,'vendorforgetpasswordSubmit']);
    Route::post('/vendorforgetpasswordnew',[VendarController::class,'vendorforgetpasswordSubmitNew']);

    Route::group( ['middleware' => ['vendorLogin:vendor'] ],function(){
        Route::get('/vendordashboard',[VendarController::class,'vendordashboard']);
        Route::get('/vendor/logout', [VendarController::class, 'logout']);
        Route::get('/vendor/changepassword', [VendarController::class, 'changePassword']);
        Route::get('/vendor/view_profile', [VendarController::class, 'viewProfile']);
        Route::post('/change_passwordSubmit',[VendarController::class,'vendorchangepasswordSubmit']);
        Route::get('/vendor/vouchers', [VendarController::class, 'vouchers'])->name('vendor.vouchers');
        Route::get('/vendor/create-voucher', [VendarController::class, 'createVoucher'])->name('vendor.create_voucher');
        Route::post('/vendor/store-voucher', [VendarController::class, 'storeVoucher'])->name('vendor.store_voucher');
        Route::get('/vendor/show-voucher-details/{id}', [VendarController::class, 'showVoucherDetails'])->name('vendor.show_vendor_details');
        Route::post('/vendor/voucher-status-update', [VendarController::class, 'voucherStatusUpdate']);
        Route::get('/vendor/voucher-edit/{id}', [VendarController::class, 'voucherEdit'])->name('vendor.edit_voucher');
        Route::post('/vendor/voucher-edit-submit', [VendarController::class, 'voucherEditSubmit'])->name('vendor.edit_voucher_submit');
        Route::get('/vendor/get-state-by-country/{country_id}', [VendarController::class, 'getStateByCountry'])->name('vendor.get_state_by_country');
        Route::get('/vendor/voucher-delete/{voucher_id}', [VendarController::class, 'voucherDelete'])->name('vendor.voucher_delete');
        Route::post('/vendor/add-voucher-category-submit', [VendarController::class, 'voucherCategorySubmit'])->name('vendor.voucher_category_submit');
        Route::post('/vendor/get-sub-category', [VendarController::class, 'getVoucherSubCategory'])->name('vendor.get_voucher_sub_category');
        Route::post('/vendor/edit-profile-submit', [VendarController::class, 'editProfile'])->name('vendor.edit_profile');
        Route::post('/vendor/add-service-photo', [VendarController::class, 'addServicePhoto'])->name('vendor.add_service_photo');
        Route::get('/vendor/delete-service-image/{id}', [VendarController::class, 'deleteServiceImage'])->name('vendor.add_service_photo');
        Route::get('/vendor/get-service-category/{category_id}', [VendarController::class, 'getServiceCategory'])->name('vendor.get_service_category');
        Route::post('/vendor/add-vendor-service-category', [VendarController::class, 'addVendorServiceCategory'])->name('vendor.add_vendor_service_category');
        Route::get('/vendor/delete-service/{id}', [VendarController::class, 'deleteService'])->name('vendor.delete_service');
        Route::get('/vendor/generate-voucher-code/{id}', [VendarController::class, 'generateVoucherCode'])->name('vendor.generate_voucher_code');
        // tasks route
        Route::get('/vendor/get-tasks', [VendarController::class, 'getTasks'])->name('vendor.get_tasks');
        Route::get('/vendor/accept-task/{id}', [VendarController::class, 'acceptTasks'])->name('vendor.accept_task');
    });

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::group(['prefix'=>'admin','middleware'=>['isAdmin','auth']],function(){

    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('users',[AdminController::class,'users'])->name('admin.users');
    Route::get('voucher',[AdminController::class,'vouchers'])->name('admin.vouchers');

    Route::get('seos',[SeoController::class,'seos'])->name('admin.seos');
    Route::get('create_seo',[SeoController::class,'create_seo'])->name('admin.create.seo');
    Route::post('store_seo',[SeoController::class,'store_seo'])->name('admin.store.seo');
    Route::get('/seo_edit/{id}',[SeoController::class,'seoEdit'])->name('seo.edit');
    Route::post('/seo_update/{id}',[SeoController::class,'updateSeo'])->name('admin.seo.update');

    Route::post('/voucher_status',[AdminController::class,'voucherStatus'])->name('voucher.status');
    Route::post('/customer_status',[AdminController::class,'userStatus'])->name('user.status');
    Route::post('/vendor_status',[AdminController::class,'userStatus'])->name('vendor.status');
    Route::get('/customer_edit/{id}',[AdminController::class,'userEdit'])->name('user.edit');
    Route::post('/customer_update/{id}',[AdminController::class,'updateUser'])->name('user.update');
    Route::post('/delete_user/{id}',[AdminController::class,'destroy'])->name('user.destroy');

    Route::get('vendors',[AdminController::class,'vendors'])->name('admin.vendors');
    Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('setting',[AdminController::class,'setting'])->name('admin.setting');
    Route::get('service-category',[AdminController::class,'serviceCategories'])->name('admin.service_category');
    Route::get('add-service-category',[AdminController::class,'addServiceCategories'])->name('admin.add_service_category');
    Route::post('submit-service-category',[AdminController::class,'submitServiceCategories'])->name('admin.submit_service_category');
    Route::get('edit-service-category/{id}',[AdminController::class,'editServiceCategories'])->name('admin.edit_service_category');
    Route::post('edit-service-category-submit',[AdminController::class,'editServiceCategoriesSubmit'])->name('admin.edit_service_category_submit');
    Route::get('delete-service-category/{id}',[AdminController::class,'deleteServiceCategoriesSubmit'])->name('admin.delete_service_category');
});
// Route::get();
Route::group(['prefix'=>'agent','middleware'=>['isAgent','auth']],function(){
    Route::get('dashboard',[AgentController::class,'index'])->name('agent.dashboard');
    Route::get('profile',[AgentController::class,'profile'])->name('agent.profile');
    Route::get('setting',[AgentController::class,'setting'])->name('agent.setting');
});

Route::group(['prefix'=>'vendar','middleware'=>['isVendar','auth']],function(){
    Route::get('dashboard',[VendarController::class,'index'])->name('vendar.dashboard');
    Route::get('profile',[VendarController::class,'profile'])->name('vendar.profile');
    Route::get('voucher',[VendarController::class,'voucher'])->name('vendar.voucher');
    Route::get('create_Voucher',[VendarController::class,'createVoucher'])->name('vendar.create_voucher');
    Route::post('store_voucher',[VendarController::class,'store_voucher'])->name('vendar.store_voucher');
    Route::get('setting',[VendarController::class,'setting'])->name('vendar.setting');
});

Route::group(['prefix'=>'user','middleware'=>['isUser','auth']],function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('setting',[UserController::class,'setting'])->name('user.setting');

});