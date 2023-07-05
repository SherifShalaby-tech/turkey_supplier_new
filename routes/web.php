<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\WebsiteController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Auth\WebLoginController;
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

//------------------------------------------------------------------\\




//Route::get('/testNotification', [FirebaseController::class, 'index'])->name('home');
//Route::post('/save-push-notification-token', [FirebaseController::class, 'savePushNotificationToken'])->name('save-push-notification-token');
//Route::post('/send-push-notification', [FirebaseController::class, 'sendPushNotification'])->name('send.push-notification');
////
////
Route::post('/admin/login', [
    'uses' => 'Auth\LoginController@login',
   'middleware' => 'Is_Active',
]);

//Route::get('password/find/{token}', 'PasswordResetController@find');
// chat
Route::get('/chat/{user_id}', [HomeController::class,'index'])->name('chat');

Route::get('/load-latest-messages', [MessagesController::class,'getLoadLatestMessages']);

Route::post('/send', [MessagesController::class,'postSendMessage']);

Route::get('/fetch-old-messages', [MessagesController::class,'getOldMessages']);
//------------------------------------------------------------------\\

//$installed = Storage::disk('public')->exists('installed');
//
//if ($installed === false) {
//    Route::get('/setup', [
//        'uses' => 'SetupController@viewCheck',
//    ])->name('setup');
//
//    Route::get('/setup/step-1', [
//        'uses' => 'SetupController@viewStep1',
//    ]);
//
//    Route::post('/setup/step-2', [
//        'as' => 'setupStep1', 'uses' => 'SetupController@setupStep1',
//    ]);
//
//    Route::post('/setup/testDB', [
//        'as' => 'testDB', 'uses' => 'TestDbController@testDB',
//    ]);
//
//    Route::get('/setup/step-2', [
//        'uses' => 'SetupController@viewStep2',
//    ]);
//
//    Route::get('/setup/step-3', [
//        'uses' => 'SetupController@viewStep3',
//    ]);
//
//    Route::get('/setup/finish', function () {
//
//        return view('setup.finishedSetup');
//    });
//
//    Route::get('/setup/getNewAppKey', [
//        'as' => 'getNewAppKey', 'uses' => 'SetupController@getNewAppKey',
//    ]);
//
//    Route::get('/setup/getPassport', [
//        'as' => 'getPassport', 'uses' => 'SetupController@getPassport',
//    ]);
//
//    Route::get('/setup/getMegrate', [
//        'as' => 'getMegrate', 'uses' => 'SetupController@getMegrate',
//    ]);
//
//    Route::post('/setup/step-3', [
//        'as' => 'setupStep2', 'uses' => 'SetupController@setupStep2',
//    ]);
//
//    Route::post('/setup/step-4', [
//        'as' => 'setupStep3', 'uses' => 'SetupController@setupStep3',
//    ]);
//
//    Route::post('/setup/step-5', [
//        'as' => 'setupStep4', 'uses' => 'SetupController@setupStep4',
//    ]);
//
//    Route::post('/setup/lastStep', [
//        'as' => 'lastStep', 'uses' => 'SetupController@lastStep',
//    ]);
//
//    Route::get('setup/lastStep', function () {
//        return redirect('/setup', 301);
//    });
//
//} else {
//    Route::any('/setup/{vue}', function () {
//        abort(403);
//    });
//}

//------------------------------------------------------------------\\

//Route::group(['middleware' => ['auth', 'Is_Active']], function () {
//
//    Route::get('/login', function () {
//        $installed = Storage::disk('public')->exists('installed');
//        if ($installed === false) {
//            return redirect('/setup');
//        } else {
//            return redirect('/login');
//        }
//    })->name('admin.login');
//
//
//    Route::get('/{vue?}',
//        function () {
//            $installed = Storage::disk('public')->exists('installed');
//            if ($installed === false) {
//                return redirect('/setup');
//            } else {
//                return view('layouts.master');
//            }
//        })->where('vue', '^(?!setup|update|password).*$');
//
//
//    });
//
//    Auth::routes([
//        'register' => false,
//    ]);

Auth::routes([
    'register' => false,
]);
////------------------------------------------------------------------\\
//
//Route::get('/update', 'UpdateController@viewStep1');
//
//Route::get('/update/finish', function () {
//
//    return view('update.finishedUpdate');
//});
////
//Route::post('/update/lastStep', [
//    'as' => 'update_lastStep', 'uses' => 'UpdateController@lastStep',
//]);



