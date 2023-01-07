<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Payment;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TypeSkipAppController;
use App\Http\Controllers\ContentGeneratorController;
use App\Http\Controllers\ToolColorController;
use App\Http\Controllers\UserBillingController;
use App\Http\Controllers\UserProfileController;

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

Route::get('/clear', function() {

    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Cleared!";
});

    // Landing Page
    Route::get('/', [HomeController::class, 'index'])->name('landing');

    // Auth Routes
    Route::get('/login',[AuthController::class, 'login'])->name('login');
    Route::post('/login',[AuthenticatedSessionController::class, 'store']);
    Route::get('/register',[AuthController::class,'register'])->name('register');
    // Auth Routes

    // Template
    Route::group(['middleware'=>['auth','access.permission']], function (){
        // Generator pages
        Route::get('/app',[TemplateController::class, 'index'])->name('app');
        Route::get('/app/{slug}/{id?}/{name?}/{response_id?}',[TypeSkipAppController::class,'showApplication'])->name('app.show');
        Route::post('/app/generate',[ContentGeneratorController::class,'generateData'])->name('generate_content');
        // Generator Colors
        Route::post('/color/store',[ToolColorController::class,'store'])->name('add_color');
        // Generator Favourite
        Route::post('/content/favourite',[ContentController::class,'favouriteContent'])->name('add_fav');
        // Generator Delete
        Route::post('/content/delete',[ContentController::class,'deleteContent'])->name('content_delete');
        Route::post('/content/force-delete',[ContentController::class,'forceDeleteContent'])->name('force_remove');
        Route::post('/content/restore-and-favourite',[ContentController::class,'contentRestoreAndFavourite'])->name('restore_fav');
        Route::post('/content/remove-from-favourite',[ContentController::class,'contentRemoveFromFavourite'])->name('remove_fav');
        // Generator All Content / Fav / Delete
        Route::get('/all/content', [ContentController::class,'allContent']);
        Route::get('/favourite/content', [ContentController::class,'getFavouriteContent']);
        Route::get('/trashed/content', [ContentController::class,'getTrashedContent']);
        // User Profile
        Route::get('profile', [UserProfileController::class,'showProfile']);
        Route::post('/profile/update/name', [UserProfileController::class,'updateProfileName'])->name('update_name');
        Route::post('/profile/update/company', [UserProfileController::class,'updateCompanyInfo'])->name('update_company');
    });

    // Pages
    Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
    Route::get('/website', [HomeController::class, 'website']);
    Route::post('/submit-newsletter', [HomeController::class, 'submitNewsletter']);
    // Members pages
    Route::match(['get', 'post'],'members', [HomeController::class, 'members'])->middleware('islogged')->middleware('user');
    Route::get('/delete/member/{id}',[HomeController::class, 'deleteRef']);
    Route::post('/update/members/{id}',[HomeController::class, 'updateRef']);
    Route::get('/update/link/{id}',[HomeController::class, 'updatelink']);
    // Logout
    Route::get('logout', [UserController::class, 'flushSession']);
    Route::post('/checkmail', [UserController::class,'checkmail']);
    // Change Password
    Route::get('/change_password', [UserController::class,'changePassword'])->middleware('islogged')->middleware('user');
    //Update Password
    Route::match(['get', 'post'],'update_password', [UserController::class, 'update_password'])->name('update_password')->middleware('islogged')->middleware('user');
    //Update User Status
    Route::get('user/update/{id?}/{name?}', [UserController::class, 'update_userStatus']);
    //Update User Preferences
    Route::post('update/update_upgrade_preference', [UserController::class, 'update_upgrade_preference']);
    Route::match(['get', 'post'],'password-recover', [UserController::class, 'password_recover'])->name('password-recover');
    Route::match(['get', 'post'], 'update_password/{id?}/{name?}', [UserController::class,'recoverpassword']);
    //Social Media Login
    Route::get('login/google', [UserController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [UserController::class, 'handleGoogleCallback']);
    // make content public accessible
    Route::group(['prefix'=>'','as'=>'generator.'],function () {
        Route::match(['get'],'google-ad/{id?}/{name?}/{response_id?}', [UserController::class, 'google_ad'])->name('google_ad');
        Route::match(['get'],'product-description/{id?}/{name?}/{response_id?}', [UserController::class, 'product_description'])->name('product_description');
    });
    //Request Template or Tool
    Route::post('/request-template', [UserController::class, 'requestTemplate'])->name('request-template');
    //Create Projects
    Route::post('create-project', [ProjectController::class, 'createProject'])->name('create-project');

// Strip payment
Route::middleware(['auth','islogged'])->group(function () {
    Route::middleware(['isOldUser'])->group(function () {
        // Request Template
        Route::get('content', [ProjectController::class, 'allContents']);
        Route::get('get-all-contents', [ProjectController::class, 'allContentsData']);
        Route::get('get-all-favorites', [ProjectController::class, 'allFavoritesData']);
        Route::get('get-all-trashed', [ProjectController::class, 'allTrashedsData']);
        Route::get('get-content-details/{ads_response_id}', [ProjectController::class, 'getContentDetails']);
        Route::get('delete-response/{ads_response_id}', [ProjectController::class, 'deleteResponse']);
        Route::get('favourite/{ads_response_id}', [ProjectController::class, 'favourite']);
        Route::get('restore/{ads_response_id}', [ProjectController::class, 'restore']);
    });
    //Update / Delete Projects
    Route::post('update-user-project', [ProjectController::class, 'updateUserProject'])->name('update-user-project');
    Route::post('delete-project', [ProjectController::class, 'deleteProject'])->name('delete-project');
    //Billing
    Route::get('billing', [UserBillingController::class, 'showBillingPage'])->name('pay-with-card');
    // Routes for car actions
    Route::post('add-card', [UserBillingController::class, 'addCard'])->name('add-card');
    Route::post('update-default-card', [UserBillingController::class, 'updateDefaultCard'])->name('update-default-card');
    Route::post('delete-card', [UserBillingController::class, 'deleteCard'])->name('delete-card');
    //Subscriptions
    Route::post('subscription', [Payment::class, 'subscription']);
    // Routes for subscriptions
    Route::post('subscription/cancel', [UserBillingController::class, 'cancelSubscription'])->name('subscription-cancel');
    Route::post('subscription/upgrade', [UserBillingController::class, 'upgradeSubscription'])->name('subscription-upgrade');
    Route::post('update/user/upgrade-pref', [UserBillingController::class, 'updateUpgradePref'])->name('subscription-upgrade-pref');
    //Invoice
    Route::get('user-invoice/{invoice}', function ($invoiceId) {
        return auth()->user()->downloadInvoice($invoiceId, [
            'vendor' => config('app.name'),
            'product' => 'Typeskip.ai ',
        ]);
    })->name('user-invoice');
    Route::post('remove-ad', [UserController::class, 'remove_ad']);
});

    //Profile Picture
    Route::post('profile/update/photo', [UserProfileController::class,'updateProfilePhoto']);

    Route::post('subscription/create', [UserBillingController::class, 'createSubscription'])->name('subscription-create');
    Route::post('pay-with-stripe/{token}', [Payment::class, 'payWithStripe']);
    Route::get('user/setup-intent', [Payment::class, 'getSetupIntent']);
    Route::post('user/payments', [Payment::class, 'postPaymentMethods']);
    Route::post('user/subscription', [Payment::class, 'updateSubscription']);
    Route::post('user/subscriptionStart', [Payment::class, 'updateSubscriptionStart']);
    Route::get('user/get-plans', [Payment::class, 'getPlan']);
    Route::get('user/get-subscription', [Payment::class, 'getSubscription']);
    Route::get('user/get-schedule-subscription', [Payment::class, 'getScheduleSubscription']);
    Route::get('user/payment-methods', [Payment::class, 'getPaymentMethods']);
    Route::post('user/remove-payment', [Payment::class, 'removePaymentMethod']);
    Route::post('update-response', [ProjectController::class, 'updateResponse'])->name('update-response');
    Route::post('report-content', [UserController::class, 'reportContent'])->name('report-content');

    // ADMIN ROUTES
    Route::match(['get', 'post'],'admin/login', [AdminController::class, 'login']);
    Route::match(['get', 'post'],'admin/register', [AdminController::class, 'register'])->middleware('logged');
    Route::get('dashboard', [AdminController::class, 'index'])->middleware('islogged')->middleware('admin');
    Route::get('users', [AdminController::class, 'index'])->middleware('islogged')->middleware('admin');
    Route::get('trail-user', [AdminController::class, 'index'])->middleware('islogged')->middleware('admin');
    Route::get('subscribe-user', [AdminController::class, 'index'])->middleware('islogged')->middleware('admin');
    Route::get('cancelled-user', [AdminController::class, 'index'])->middleware('islogged')->middleware('admin');
    Route::get('cancelled-user', [AdminController::class, 'index'])->middleware('islogged')->middleware('admin');
    Route::match(['get', 'post'],'manage-page', [AdminController::class, 'manage_page'])->middleware('islogged')->middleware('admin');
    Route::match(['get', 'post'],'pricing', [AdminController::class, 'pricing'])->middleware('islogged')->middleware('admin');
    Route::match(['get', 'post'],'logo/create', [AdminController::class, 'create_logo'])->middleware('admin');
    Route::post('fetch_price', [AdminController::class, 'fetch_price']);
    Route::get('remove-gif/{id?}', [AdminController::class, 'remove_gif'])->middleware('islogged')->middleware('admin');
    Route::match(['get', 'post'],'g-tag', [AdminController::class, 'g_tag'])->middleware('islogged')->middleware('admin');
    Route::get('buy-plan', [UserBillingController::class, 'buyPlan'])->name('new-sign-up');

    //webhook
    Route::stripeWebhooks('stripe/webhook');

    //testing
    Route::get('getList', [HomeController::class, 'getList']);
    Route::get('createContact', [HomeController::class, 'createContact']);
    Route::get('getContact', [HomeController::class, 'getContact']);
    Route::get('getContactByEmail', [HomeController::class, 'getContactByEmail']);
    Route::get('deleteContact', [HomeController::class, 'deleteContact']);
