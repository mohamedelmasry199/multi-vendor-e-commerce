<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AjaxController;
use App\Http\Controllers\admin\auth\AuthenticatedSessionController;
use App\Http\Controllers\admin\auth\ConfirmablePasswordController;
use App\Http\Controllers\admin\auth\EmailVerificationNotificationController;
use App\Http\Controllers\admin\auth\EmailVerificationPromptController;
use App\Http\Controllers\admin\auth\NewPasswordController;
use App\Http\Controllers\admin\auth\PasswordController;
use App\Http\Controllers\admin\auth\PasswordResetLinkController;
use App\Http\Controllers\admin\auth\VerifyEmailController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\CurrencyController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ItemController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('admin')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* --------------------------------users ----------------------------------------------------*/

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UsersController::class);
    Route::get('/get-cities/{country}', [UsersController::class, 'getCities'])->name('getCities');
    Route::post('/users/search', [UsersController::class, 'search'])->name('users.search');
    Route::get('/users/filter', [UsersController::class, 'filter'])->name('users.filter');
    Route::get('users/export-csv', [UsersController::class, 'exportCSV'])->name('users.export');
    Route::post('/active',  [UsersController::class, 'active'])->name('active_users');
    Route::get('/users/live-search', [UsersController::class, 'liveSearch'])->name('users.liveSearch');


        /* --------------------------------categories ----------------------------------------------------*/

    Route::resource('categories', CategoriesController::class);
    Route::post('/categories/search', [CategoriesController::class, 'search'])->name('categories.search');
    Route::get('export-csv/categories', [CategoriesController::class, 'exportCSV'])->name('categories.export');
    Route::get('getCategories', [CategoriesController::class, 'getCategories'])->name('getCategories');
    Route::get('categories/filter', [CategoriesController::class, 'filter'])->name('categories.filter');


            /* --------------------------------items ----------------------------------------------------*/

    Route::resource('items', ItemController::class);
    Route::get('items-export', [ItemController::class, 'exportCSV'])->name('items.export');
    Route::get('items-filter', [ItemController::class, 'filter'])->name('items.filter');
    Route::post('/active/item',  [ItemController::class, 'active'])->name('active_items');
    Route::post('/items/search', [ItemController::class, 'search'])->name('items.search');
    Route::get('/categories/children/{id}', [ItemController::class, 'getChildren']);


                /* --------------------------------orders ----------------------------------------------------*/
    Route::resource('orders', OrderController::class);
    Route::get('orders-export', [OrderController::class, 'exportCSV'])->name('orders.export');
    Route::get('orders-filter', [OrderController::class, 'filter'])->name('orders.filter');
    Route::post('/orders/search', [OrderController::class, 'search'])->name('orders.search');
    Route::get('products/search', [OrderController::class, 'searchProducts'])->name('products.search');


             /* --------------------------------settings ----------------------------------------------------*/

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

            /* --------------------------------countries----------------------------------------------------*/

    Route::resource('countries', CountryController::class);
    Route::get('countries-export', [CountryController::class, 'exportCSV'])->name('countries.export');
    Route::get('countries-filter', [CountryController::class, 'filter'])->name('countries.filter');
    Route::post('/countries/search', [CountryController::class, 'search'])->name('countries.search');

            /* --------------------------------cities----------------------------------------------------*/

    Route::resource('cities', CityController::class);
    Route::get('cities-export', [CityController::class, 'exportCSV'])->name('cities.export');
    Route::get('cities-filter', [CityController::class, 'filter'])->name('cities.filter');
    Route::post('/cities/search', [CityController::class, 'search'])->name('cities.search');

      /* --------------------------------currencies----------------------------------------------------*/

      Route::resource('currencies', CurrencyController::class);
      Route::get('currencies-export', [CurrencyController::class, 'exportCSV'])->name('currencies.export');
      Route::get('currencies-filter', [CurrencyController::class, 'filter'])->name('currencies.filter');
      Route::post('/currencies/search', [CurrencyController::class, 'search'])->name('currencies.search');
      Route::post('/main',  [CurrencyController::class, 'main'])->name('currencies.main');

      Route::resource('static_pages', StaticPageController::class);


      Route::resource('roles', RoleController::class);

        Route::resource('admins', AdminController::class);
        Route::get('/get-cities/{country}', [AdminController::class, 'getCities'])->name('getCities');
        Route::post('/admins/search', [AdminController::class, 'search'])->name('admins.search');
        Route::get('admins-export-csv', [AdminController::class, 'exportCSV'])->name('admins.export');
        Route::post('/active-admins',  [AdminController::class, 'active'])->name('active_admins');
        Route::get('/admins/live-search', [AdminController::class, 'liveSearch'])->name('admins.liveSearch');
        Route::get('/filter-admins', [AdminController::class, 'filter'])->name('admins.filter');




});
