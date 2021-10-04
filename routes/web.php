<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Models\Brand;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AboutController;
use App\Models\About;
use App\Models\Multipic;

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

Route::get('/', function () {
    $brands = Brand::all();
    $about = About::first();
    $portfolio_images = Multipic::all();
    return view('home', compact('brands', 'about', 'portfolio_images'));
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/about', function () {
    return view('about');
});


// Email verify
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


//Category

Route::get('/category/all',  [CategoryController::class, 'allCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'addCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/category/soft-delete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/category/p-delete/{id}', [CategoryController::class, 'forceDelete']);


//Brand
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);

//Multi Image
Route::get('/multi-pic', [BrandController::class, 'multiPic'] )->name('multi.image');
Route::post('/mulit-pic/add', [BrandController::class, 'storeImage'])->name('store.image');

// Slider
Route::get('/slider', [SliderController::class, 'index'])->name('home.slider');
Route::get('/slider/add', [SliderController::class, 'addSlider'])->name('add.slider');
Route::post('/slider/create', [SliderController::class, 'store'])->name('store.slider');
Route::get('/slider/edit/{id}', [SliderController::class, 'edit']);
Route::post('/slider/update/{id}', [SliderController::class, 'update']);
Route::get('/slider/delete/{id}', [SliderController::class, 'destroy']);

//About

Route::get('/about', [AboutController::class, 'index'])->name('home.about');
Route::get('/about/add', [AboutController::class, 'addAbout'])->name('add.about');
Route::post('/about/create', [AboutController::class, 'store'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'edit']);
Route::post('/about/update/{id}', [AboutController::class, 'update']);
Route::get('/about/delete/{id}', [AboutController::class, 'destroy']);


// Portfolio page route

Route::get('/portfolio', function(){
    $portfolio_images = Multipic::all();
    return view('pages.portfolio', compact('portfolio_images'));
})->name('portfolio');


// Contact

Route::get('/admin/contact/', [ContactController::class, 'adminContact'])->name('admin.contact');
Route::get('/admin/contact/add', [ContactController::class, 'addContact'])->name('add.contact');
Route::post('/admin/contact/create', [ContactController::class, 'store'])->name('store.contact');
Route::get('/admin/contact/edit/{id}', [ContactController::class, 'edit']);
Route::post('/admin/contact/update/{id}', [ContactController::class, 'update']);
Route::get('/admin/contact/delete/{id}', [ContactController::class, 'destroy']);

Route::get('/admin/contact/message', [ContactController::class, 'contactMessage'])->name('admin.contact.message');
Route::get('/admin/contact/message/delete/{id}', [ContactController::class, 'messageDestroy']);


// Contact Page Route
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-form', [ContactController::class, 'contactForm'])->name('contact.form');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/user/change-password', [UserController::class, 'cPassword'])->name('change.password');
Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('password.update');
Route::get('/user/profile-update', [UserController::class, 'profileUpdate'])->name('profile.update');
Route::post('/user/update-profile', [UserController::class, 'update'])->name('user.profile.update');
