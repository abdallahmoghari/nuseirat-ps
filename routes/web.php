<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('view.index');
Route::redirect('/admin', '/cms/loginType');

Route::prefix('cms/')->middleware('guest:admin,author')->group(function () {
    Route::get('loginType', [UserAuthController::class, 'loginType'])->name('login.type');
    Route::get('{guard}/login', [UserAuthController::class, 'showLogin'])->name('view.login')->where('guard', 'admin|author');
    Route::post('{guard}/login', [UserAuthController::class, 'login'])->where('guard', 'admin|author');
});

Route::prefix('cms/admin/')->middleware('auth:admin,author')->group(function () {
    Route::get('logout', [UserAuthController::class, 'logout'])->name('view.logout');
    Route::get('changePassword', [UserAuthController::class, 'changePassword'])->name('changePassword');
    Route::post('updatePassword', [UserAuthController::class, 'updatePassword'])->name('updatePassword');
    Route::get('edit-profile', [UserAuthController::class, 'editProfile'])->name('edit-profile');
    Route::post('update-profile', [UserAuthController::class, 'updateProfile'])->name('update-profile');
    Route::get('profile', [UserAuthController::class, 'profile'])->name('user.profile');

    Route::view('parent', 'cms.parent');
    Route::view('', 'cms.home')->name('mainPage');

    Route::resource('countries', CountryController::class);
    Route::post('countries-update/{id}', [CountryController::class, 'update'])->name('countries-update');
    Route::get('countries-trashed', [CountryController::class, 'indexTrashed'])->name('countries-trashed');
    Route::post('countries-restore/{id}', [CountryController::class, 'restore'])->name('countries-restore');
    Route::post('countries-forceDelete/{id}', [CountryController::class, 'forceDelete'])->name('countries-forceDelete');
    Route::post('countries-forceDeleteAll', [CountryController::class, 'forceDeleteAll'])->name('countries-forceDeleteAll');

    Route::resource('cities', CityController::class);
    Route::post('cities-update/{id}', [CityController::class, 'update'])->name('cities-update');

    Route::resource('categories', CategoryController::class);
    Route::post('categories-update/{id}', [CategoryController::class, 'update'])->name('categories-update');

    Route::resource('articles', ArticleController::class);
    Route::post('articles-update/{id}', [ArticleController::class, 'update'])->name('articles-update');
    Route::get('indexArticle/{id}', [ArticleController::class, 'indexArticle'])->name('indexArticle');
    Route::get('createArticle/{id}', [ArticleController::class, 'createArticle'])->name('createArticle');

    Route::resource('admins', AdminController::class);
    Route::post('admins-update/{id}', [AdminController::class, 'update'])->name('admins-update');

    Route::resource('authors', AuthorController::class);
    Route::post('authors-update/{id}', [AuthorController::class, 'update'])->name('authors-update');

    Route::resource('sliders', SliderController::class);
    Route::post('sliders-update/{id}', [SliderController::class, 'update'])->name('sliders-update');

    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::post('roles-update/{id}', [RoleController::class, 'update'])->name('roles-update');

    Route::resource('permissions', PermissionController::class);
    Route::post('permissions-update/{id}', [PermissionController::class, 'update'])->name('permissions-update');

    Route::resource('roles.permissions', RolePermissionController::class);
});

// --- Citizen Frontend Routes ---
Route::prefix('citizen')->group(function () {
    Route::get('register', [App\Http\Controllers\CitizenAuthController::class, 'showRegister'])->name('citizen.register');
    Route::post('register', [App\Http\Controllers\CitizenAuthController::class, 'register'])->name('citizen.register');
    Route::get('login', [App\Http\Controllers\CitizenAuthController::class, 'showLogin'])->name('citizen.login');
    Route::post('login', [App\Http\Controllers\CitizenAuthController::class, 'login'])->name('citizen.login');
    Route::get('logout', [App\Http\Controllers\CitizenAuthController::class, 'logout'])->name('citizen.logout');

    Route::middleware('auth:citizen')->group(function () {
        Route::get('services', [App\Http\Controllers\CitizenServiceController::class, 'services'])->name('citizen.services');
        Route::get('services/create/{type}', [App\Http\Controllers\CitizenServiceController::class, 'createRequest'])->name('citizen.create-request');
        Route::post('services/store', [App\Http\Controllers\CitizenServiceController::class, 'storeRequest'])->name('citizen.store-request');
        Route::get('my-requests', [App\Http\Controllers\CitizenServiceController::class, 'myRequests'])->name('citizen.my-requests');
        Route::get('my-requests/{id}', [App\Http\Controllers\CitizenServiceController::class, 'showRequest'])->name('citizen.show-request');
        Route::get('inquiry', [App\Http\Controllers\CitizenServiceController::class, 'inquiryForm'])->name('citizen.inquiry');
        Route::post('inquiry', [App\Http\Controllers\CitizenServiceController::class, 'storeInquiry'])->name('citizen.store-inquiry');
        Route::get('profile', [App\Http\Controllers\CitizenServiceController::class, 'profile'])->name('citizen.profile');
    });
});

// --- Service Employee Routes (CMS-style) ---
Route::prefix('cms/service-employee/')->middleware('guest:service_employee')->group(function () {
    Route::get('login', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'showLogin'])->name('service-employee.login');
    Route::post('login', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'login'])->name('service-employee.login');
});

Route::prefix('cms/service-employee/')->middleware('auth:service_employee')->group(function () {
    Route::get('logout', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'logout'])->name('service-employee.logout');
    Route::get('dashboard', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'dashboard'])->name('service-employee.dashboard');
    Route::get('requests', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'requests'])->name('service-employee.requests');
    Route::get('requests/{id}', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'showRequest'])->name('service-employee.show-request');
    Route::post('requests/{id}/update-status', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'updateStatus'])->name('service-employee.update-status');
    Route::get('inquiries', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'inquiries'])->name('service-employee.inquiries');
    Route::get('inquiries/{id}', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'showInquiry'])->name('service-employee.show-inquiry');
    Route::post('inquiries/{id}/respond', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'respondInquiry'])->name('service-employee.respond-inquiry');
    Route::get('profile', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'profile'])->name('service-employee.profile');
    Route::post('update-profile', [App\Http\Controllers\ServiceEmployeeAuthController::class, 'updateProfile'])->name('service-employee.update-profile');
});

Route::prefix('home')->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('home');
    Route::get('category/{slug}', [HomeController::class, 'allNews'])->name('category');
    Route::get('article/{slug}', [HomeController::class, 'detailes'])->name('article');
    Route::get('contact-us', [HomeController::class, 'showContact'])->name('contact');
    Route::post('contacts', [HomeController::class, 'storeContact'])->name('contacts.send');
    Route::get('about', [HomeController::class, 'about'])->name('about');
    Route::get('services', [HomeController::class, 'services'])->name('services');
});
