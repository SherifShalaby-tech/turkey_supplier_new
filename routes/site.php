<?php
// website route

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\WebLoginController;
use \App\Http\Controllers\WebsiteController;
use \App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SitemapController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'clerk']
    ], function(){
        Route::get('/',[WebsiteController::class,'index'])->name('website.index');

        Route::get('/webLogin', [WebLoginController::class, 'login'])->name('webLogin');
        Route::post('/post/login',[WebLoginController::class,'postLogin'])->name('user.post.login');
        Route::get('/webRegister', [WebLoginController::class, 'register'])->name('webRegister');
        Route::post('register',[WebLoginController::class,'postRegister'])->name('post.register');
        Route::get('logoutclerk',[WebLoginController::class,'logoutclerk'])->name('web.clerklogout');

        Route::get('/resetPassword/{token}', [WebsiteController::class, 'ResetPasswordView'])->name('resetPass');
        Route::post('/post/password',[WebsiteController::class,'ResetPassword'])->name('post.password');
        // Route::group(['middleware' =>'auth:admin'], function() {


 
Route::get('sitemap.xml', [SitemapController::class, 'index' ])->name('website.sitemap');

        // });
            Route::get('/site',[WebsiteController::class,'index'])->name('website.index');
            Route::get('currency',[WebsiteController::class,'currencySession'])->name('change.currency');
            Route::get('newArrivals',[WebsiteController::class,'getNewArrivals'])->name('website.new_arrivals');
            Route::get('product/{id}/{slug}',[WebsiteController::class,'getProductDetails'])->name('product.details');
            Route::get('search/product',[WebsiteController::class,'searchProduct'])->name('product.search');
            Route::get('public/search/product',[WebsiteController::class,'publicSearch'])->name('product.public.search');
            Route::get('shipping/air_freight',[WebsiteController::class,'air_freight'])->name('shipping.air_freight');
            Route::get('shipping/sea_freight',[WebsiteController::class,'sea_freight'])->name('sea_freight');

            Route::post('public/imagesearch/product',[WebsiteController::class,'searchWithImage'])->name('product.public.imagesearch');
            Route::get('public/imagesearch/product',[WebsiteController::class,'getsearchWithImage'])->name('product.public.imagesearch.get');

            // social media auth [login and register]
            // redirect function
            Route::get('auth/login/{provider}',[WebsiteController::class,'redirectToProvider'])->name('social.redirectToProvider');
            // callback function
            Route::get('auth/{provider}/callback',[WebsiteController::class,'callbackToProvider'])->name('social.callbackToProvider');
            Route::get('about-us',[WebsiteController::class,'about_us'])->name('about_us');

            Route::get('shipping',[WebsiteController::class,'shipping'])->name('shipping');//ddddddddddddddddddddddddddddddddddddddddddddddd
            Route::get('shipping/{id}',[WebsiteController::class,'shippingDetails'])->name('shipping.details'); //ddddddddddddddddddddddd
            Route::post('shipping_new_order',[WebsiteController::class,'shippingOrder'])->name('shipping.new_order');
            Route::post('subscribe',[WebsiteController::class,'subscribe'])->name('subscribe');
            //get all categories
            Route::get('categories',[WebsiteController::class,'getAllCategories'])->name('categories.index');
            Route::get('filterSubCategories',[WebsiteController::class,'getFilterItems'])->name('categories.filterSubCategory');
            // get subcategories by category id
            Route::get('category/{name}/subcategories',[WebsiteController::class,'getProducts'])->name('category.products');
            Route::get('subcategory/{id}/products',[WebsiteController::class,'getAllProducts'])->name('subcategory.products');
            // mediation
            Route::get('mediation',[WebsiteController::class,'mediation'])->name('mediation');
            //tradeShow
            Route::get('trade-show',[WebsiteController::class,'tradeShow'])->name('tradeShow');
            // translationServices
            Route::get('translation-services',[WebsiteController::class,'translationServices'])->name('translationServices');
            Route::get('translation-services-request',[WebsiteController::class,'translationServicesRequest'])->name('translationServicesRequest');
            Route::post('post/translation-services-request',[WebsiteController::class,'postTranslationServicesRequest'])->name('postTranslationServices');
            // supplier profile
            Route::get('supplier/{id}',[WebsiteController::class,'getSupplierProfile'])->name('supplier.profile');
            // mediation request
            Route::get('mediation/request',[WebsiteController::class,'mediationRequest'])->name('mediation_request');
            Route::post('post/mediation/request',[WebsiteController::class,'postMediationRequest'])->name('post_mediation_request');
            // membership
            Route::get('membership',[WebsiteController::class,'membership'])->name('membership');
            // helpCenter
            Route::get('help-center',[WebsiteController::class,'helpCenter'])->name('helpCenter');
            // polices roles
            Route::get('polices-roles',[WebsiteController::class,'policesRoles'])->name('policesRoles');
            // contact us route
            Route::get('contact-us',[WebsiteController::class,'contactUs'])->name('contactUs');
            Route::post('post-contact-us',[WebsiteController::class,'postContactUs'])->name('postContactUs');

            Route::get('company/{id}',[WebsiteController::class,'getCompanyProducts'])->name('getCompanyProducts');

            Route::get('you_may_like/products',[WebsiteController::class,'getProductsYouMayLike'])->name('getProductsYouMayLike');
            Route::get('trending/products',[WebsiteController::class,'getTrendingProducts'])->name('getTrendingProducts');
            Route::get('sellers',[WebsiteController::class,'getSellers'])->name('getSellers');
            Route::get('filterSellers',[WebsiteController::class,'getFilterSellers'])->name('filterSellers');
            // plan payment
            Route::get('plan/payment',[WebsiteController::class,'planPayment'])->name('planPayment');
            // get supplier by subcategories
            Route::get('subcategory/{id}/suppliers',[WebsiteController::class,'getSuppliersBySubcategory'])->name('getSuppliersBySubcategory');
            // auth routes
            Route::post('contact/visitorContactSupplier',[WebsiteController::class,'visitorContactSupplier'])->name('visitorContactSupplier'); //guest send message to suppliers
            // download file
            Route::get('download/file/{fileName}',[WebsiteController::class,'downloadFiles'])->name('downloadFile');
            // support chat
            Route::get('chat/support/message',[WebsiteController::class,'getMessagesSupport'])->name('chat.support.get.message');
            Route::post('chat/support',[WebsiteController::class,'sendMessageSupport'])->name('chat.support.send.message');
            // reset password
            Route::get('buyer/reset/password',[WebsiteController::class,'buyerResetPassword'])->name('buyer.reset.password');
            Route::group(['middleware' => 'auth:company'],function(){
                // auth routes
                Route::get('logout',[WebLoginController::class,'logout'])->name('web.logout');
                // buyer profile
                Route::get('buyer/{id}/profile',[WebsiteController::class,'buyerProfile'])->name('buyer.profile');
                // buyer edit profile
                Route::get('buyer/{id}/edit/profile',[WebsiteController::class,'buyerEditProfile'])->name('buyer.edit.profile');
                // update profile
                Route::put('buyer/update/profile',[WebsiteController::class,'buyerUpdateProfile'])->name('buyer.update.profile');
                // fav page
                Route::get('user/favorite',[WebsiteController::class,'getFavPage'])->name('user.fav');
                // product add to cart
                Route::post('add/product/carts',[\App\Http\Controllers\CartController::class,'addProduct'])->name('carts.add.product');
                // get carts page
                Route::get('user/cart',[\App\Http\Controllers\CartController::class,'getCartPage'])->name('cart.get.products');
                // delete product from cart
                Route::get('delete/product/{id}/{cart_id}',[\App\Http\Controllers\CartController::class,'deleteProductFromCart'])->name('cart.product.delete');
                // save product in cart
                Route::post('save/product',[\App\Http\Controllers\CartController::class,'saveProduct'])->name('cart.save.product');
                // confirm cart
                Route::post('confirm/cart',[\App\Http\Controllers\CartController::class,'confirmCart'])->name('cart.confirm.cart');
                // shipment order
                Route::post('shipment/order',[WebsiteController::class,'shipment_order'])->name('shipment_order');//dddddddddddddddddddddddddddddddd
                // contact supplier
                Route::post('contact/supplier',[WebsiteController::class,'contactSupplier'])->name('contact_supplier');
                // user add rating
                Route::post('product/rating',[WebsiteController::class,'productRating'])->name('product.rating');
                // user orders
                Route::get('user/orders',[WebsiteController::class,'getOrders'])->name('user.orders');
                // order details
                Route::get('order/{id}/details',[WebsiteController::class,'orderDetails'])->name('order.details');
                // order payment
                Route::get('order/{id}/pay',[WebsiteController::class,'payment'])->name('order.payment');
                // show user messages with supplier
                Route::get('user/messages/suppliers',[WebsiteController::class,'showMessagesWithSuppliers'])->name('messages.suppliers.show');
                // add order by sample
                Route::post('post/sample',[\App\Http\Controllers\CartController::class,'get_a_sample'])->name('get_a_sample');
                // order timeline
                Route::get('order/{order_number}/timeline',[WebsiteController::class,'getTimelineOrders'])->name('getTimelineOrders');
                // add fav
                Route::post('add/product/fav',[\App\Http\Controllers\Favcontroller::class,'addFav'])->name('fav.add');
                // delete fav
                Route::delete('remove/product/fav',[\App\Http\Controllers\Favcontroller::class,'removeFav'])->name('fav.remove');
                //reset password
                //change currency
                Route::post('product/change/currency',[WebsiteController::class,'changeCurrency'])->name('productChangeCurrency');
            });
    // });
});
