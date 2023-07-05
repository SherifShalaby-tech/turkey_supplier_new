<?php

use App\Http\Controllers\Admin\AboutnewController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\ClerkController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CompanyUserController;
use App\Http\Controllers\Admin\ContactSupplierController;
use App\Http\Controllers\Admin\HelpcenterController;
use App\Http\Controllers\Admin\LeadtimeController;
use App\Http\Controllers\Admin\MediationController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TradeShowController;
use App\Http\Controllers\Auth\AdminLoginController;
use \App\Http\Controllers\Admin\TranslationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TranslationServicesController;
use \App\Http\Controllers\Admin\MediationReuestController;
use App\Http\Controllers\Admin\NewcatController;
use App\Http\Controllers\Admin\NewsubcatController;
use App\Http\Controllers\Admin\PoliceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PlancheckoutController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\Company\CompanyProfileController;

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('logout/', [AdminLoginController::class, 'logout'])->name('logout');
});
Route::group(
    [
        // 'auth:admin,company',
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:admin,company,clerk','admin'],
    ], function () {
            Route::group(['as' => 'admin.', 'prefix' => 'dashboard'], function () {
                Route::view('/home', 'Admin.home')->name('home');
                // super admin route
                Route::resource('admins', AdminController::class)->except(['show']);
                Route::get('/admins/data', [AdminController::class,'data'])->name('admins.data');
                Route::get('/admin/change_status/{id}', [AdminController::class,'change_status'])->name('change_status');
                // Route::get('/admins/employees',[AdminController::class,'employee'])->name('employees');
                // Route::get('/admins/employees/employeedata', [AdminController::class,'employeeData'])->name('employees.data');

                // reports
                Route::get('reports',[ReportController::class , 'reports'])->name('reports');
                Route::get('reports/data',[ReportController::class , 'reportsdata'])->name('reportsdata');

                Route::get('buyerreports',[ReportController::class , 'buyerreports'])->name('buyerreports');
                Route::get('buyerreportsdata',[ReportController::class , 'buyerreportsdata'])->name('buyerreportsdata');

                Route::get('visitoreports',[ReportController::class , 'visitoreports'])->name('visitoreports');
                Route::get('visitoreportsdata',[ReportController::class , 'visitoreportsdata'])->name('visitoreportsdata');
                // end reports
                Route::resource('companies', CompanyController::class)->except(['show']);
                Route::get('/companies/data', [CompanyController::class,'data'])->name('companies.data');
                Route::get('companies/showdata/{id}', [CompanyController::class,'showdata'])->name('companies.showdata');
                Route::post('/companies/remove_image', [CompanyController::class,'remove_image'])->name('companies.remove_image');
                Route::post('/companies/upload_image', [CompanyController::class,'upload_image'])->name('companies.upload_image');
                Route::get('/companies/change_status/{id}', [CompanyController::class,'change_status'])->name('companies.change_status');

                Route::resource('clients', ClientController::class)->except(['show']);
                Route::get('/clients/data', [ClientController::class,'data'])->name('clients.data');
                Route::get('clients/showdata/{id}', [ClientController::class,'showdata'])->name('clients.showdata');
                Route::post('/clients/remove_image', [ClientController::class,'remove_image'])->name('clients.remove_image');
                Route::post('/clients/upload_image', [ClientController::class,'upload_image'])->name('clients.upload_image');
                // clerk route
                Route::resource('clerks', ClerkController::class)->except(['show']);
                Route::get('/clerks/data', [ClerkController::class,'data'])->name('clerks.data');
                Route::get('/clerk/change_status/{id}', [ClerkController::class,'change_status'])->name('change_status');
                // end clerk route
                // category route
                Route::resource('categories',CategoryController::class)->except(['show']);
                Route::get('categories/data', [CategoryController::class,'data'])->name('categories.data');
                Route::get('category/{id}',[CategoryController::class,'getSubCategory'])->name('getSubCategory');
                // subcategories route
                Route::resource('subcategories',SubCategoryController::class)->except(['show']);
                Route::get('subcategories/data', [SubCategoryController::class,'data'])->name('subcategories.data');
                Route::get('/company-users/{id}', [companyUserController::class,'index'])->name('users.index');
                // products
                Route::resource('products',\App\Http\Controllers\Admin\ProductController::class)->except(['show']);
                Route::get('products/data', [\App\Http\Controllers\Admin\ProductController::class,'data'])->name('products.data');
                Route::get('products/showdata/{id}', [\App\Http\Controllers\Admin\ProductController::class,'showdata'])->name('products.showdata');
                Route::post('/products/remove_image', [\App\Http\Controllers\Admin\ProductController::class,'remove_image'])->name('products.remove_image');
                Route::post('/products/upload_image', [\App\Http\Controllers\Admin\ProductController::class,'upload_image'])->name('products.upload_image');
                Route::post('/products/addcat', [\App\Http\Controllers\Admin\ProductController::class,'addcat'])->name('products.addcat');
                Route::post('/products/addsubcat', [\App\Http\Controllers\Admin\ProductController::class,'addsubcat'])->name('products.addsubcat');

                // colors size ads and leadtime
                Route::resource('aboutnews',AboutnewController::class)->except('show');
                Route::resource('colors',ColorController::class)->except('show');
                Route::resource('sizes',SizeController::class)->except('show');
                Route::resource('leadtimes',LeadtimeController::class)->except('show');
                Route::resource('ads',AdController::class)->except('show');
                Route::resource('mediations',MediationController::class)->except('show');
                Route::resource('translations',TranslationController::class)->except('show');
                Route::resource('contactSuppliers',ContactSupplierController::class)->except('show');
                Route::get('contactSuppliers/sent',[ContactSupplierController::class ,'indexSend'])->name('contactSuppliers.indexSend');
                
                Route::get('contactSuppliers/showdata/{id}', [ContactSupplierController::class,'showdata'])->name('contactSuppliers.showdata');
                Route::delete('/contactSuppliers/bulk_delete/{ids}', [ContactSupplierController::class,'bulkDelete'])->name('contactSuppliers.bulk_delete');
                  // translationServices
                Route::resource('translationServices',TranslationServicesController::class)->except('show');
                Route::get('/translationServices/data', [TranslationServicesController::class,'data'])->name('translationServices.data');
                // services
                Route::resource('services',\App\Http\Controllers\Admin\ServiceController::class)->except('show');
                Route::get('services/data', [\App\Http\Controllers\Admin\ServiceController::class,'data'])->name('services.data');
                Route::post('/services/remove_image', [\App\Http\Controllers\Admin\ServiceController::class,'remove_image'])->name('services.remove_image');
                //plans
                Route::resource('plans', PlanController::class)->except(['show']);
                Route::get('/plans/data', [PlanController::class,'data'])->name('plans.data');
                Route::get('/plans/checkout/{plan}', [PlanController::class,'checkout'])->name('plans.checkout');
                Route::post('/plans/checkoutorder', [PlanController::class,'checkoutorder'])->name('plans.checkoutorder');

                Route::resource('plancheckouts', PlancheckoutController::class)->except(['show']);
                Route::get('/plancheckouts/data', [PlancheckoutController::class,'data'])->name('plancheckouts.data');
                Route::get('/plancheckouts/change_status/{id}', [PlancheckoutController::class,'change_status'])->name('plancheckouts.change_status');
                Route::get('plancheckouts/showdata/{id}', [PlancheckoutController::class,'showdata'])->name('plancheckouts.showdata');

                Route::get('/settings', [SettingController::class,'edit'])->name('settings.edit');
                Route::put('/settings/update', [SettingController::class,'update'])->name('settings.update');

                // MediationRequest route
                Route::resource('MediationRequest',MediationReuestController::class)->except('show');
                Route::get('MediationRequest/data', [MediationReuestController::class,'data'])->name('MediationRequest.data');

                // about us route
                Route::get('about-us',[SettingController::class,'about_us'])->name('about_us');
                Route::put('post/about-us',[SettingController::class,'post_about_us'])->name('post_about_us');
                Route::resource('tradeShows',TradeShowController::class)->except('show');
                Route::get('tradeShows/data', [TradeShowController::class,'data'])->name('tradeShows.data');
                Route::post('/tradeShows/remove_image', [TradeShowController::class,'remove_image'])->name('tradeShows.remove_image');
                Route::get('messages',[MessageController::class,'messages'])->name('messages');
                Route::get('message/{id}',[MessageController::class,'getSingleMessage'])->name('message.show');

                // reports

                Route::resource('helpcenters',HelpcenterController::class)->except('show');
                Route::resource('polices',PoliceController::class)->except('show');
                // contactus
                Route::get('contact-us',[SettingController::class,'contactus'])->name('contact-us');
                Route::get('contact-us/data',[SettingController::class,'contactData'])->name('contact-us.data');
                // orders route
                Route::resource('orders',OrderController::class)->except('show');
                Route::get('orders/data',[OrderController::class,'data'])->name('orders.data');
                Route::get('orders/details/{id}',[OrderController::class,'details'])->name('orders.details');

                Route::resource('chats', ChatController::class)->except(['show']);
                Route::get('/chats/data', [ChatController::class,'data'])->name('chats.data');
                Route::post('/chats/replay', [ChatController::class,'replay'])->name('chats.replay');

                Route::resource('newcat',NewcatController::class)->except(['show']);
                Route::get('newcat/data', [NewcatController::class,'data'])->name('newcats.data');

                Route::resource('newsubcat',NewsubcatController::class)->except(['show']);
                Route::get('newsubcat/data', [NewsubcatController::class,'data'])->name('newsubcats.data');

                Route::resource('shippings',ShippingController::class)->except(['show','create','store','edit','update']);
                Route::get('shippings/data', [ShippingController::class,'data'])->name('shippings.data');
                Route::get('shippings/showdata/{id}', [ShippingController::class,'showdata'])->name('shippings.showdata');
                // shipment services
                Route::resource('shipmentService',\App\Http\Controllers\Admin\ShipmentServiceController::class);
            });

            Route::group(['as' => 'company.', 'prefix' => 'company'], function () {
                Route::get('/company/profile', [CompanyProfileController::class,'profile'])->name('company.profile');
                Route::post('/company/changePassword/{id}', [CompanyProfileController::class,'changePassword'])->name('company.changePassword');
                Route::put('/company/updatecompany', [CompanyProfileController::class,'updatecompany'])->name('company.updatecompany');
            });

            Route::get('subscribe',[SubscribeController::class , 'getSubScribe'])->name('subscribe');
           // Route::get('subscribe/data',[SubscribeController::class,'data'])->name('subscribe.data');
    });

?>
