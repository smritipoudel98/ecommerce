<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
Route::get('/', [HomeController::class, 'home']);


Route::get('/stripe/{value}', [StripePaymentController::class, 'stripe'])->name('stripe.form');
Route::post('/stripe/{value}', [StripePaymentController::class, 'stripePost'])->name('stripe.post');


Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
Route::get('/testimonial', [TestimonialController::class, 'showTestimonials'])->name('testimonial.show');

//email verification
// Email verification notice (page that tells user to verify email)



Route::get('/dashboard', [HomeController::class, 'login_home']) // ✅ fixed
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class,'index'])->
middleware(['auth', 'admin']);

Route::get('view_category',[AdminController::class,'view_category'])->
middleware(['auth', 'admin']);

Route::post('add_category',[AdminController::class,'add_category'])->
middleware(['auth', 'admin']);

Route::delete('delete_category/{id}',[AdminController::class,'delete_category'])->
middleware(['auth', 'admin']);


// Show form
Route::get('edit_category/{id}', [AdminController::class, 'edit_category_form'])->middleware(['auth', 'admin']);

// Handle update
Route::post('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth', 'admin']);

//update button category
Route::post('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth', 'admin']);

Route::get('add_product',[AdminController::class,'add_product'])->
middleware(['auth', 'admin']);

Route::post('upload_product',[AdminController::class,'upload_product'])->
middleware(['auth', 'admin']);

Route::get('view_product',[AdminController::class,'view_product'])->
middleware(['auth', 'admin']);

Route::delete('delete_product/{id}',[AdminController::class,'delete_product'])->
middleware(['auth', 'admin']);

Route::get('update_product/{slug}',[AdminController::class,'update_product'])->
middleware(['auth', 'admin']);

Route::post('edit_product/{id}',[AdminController::class,'edit_product'])->
middleware(['auth', 'admin']);

Route::get('product_search',[AdminController::class,'product_search'])->
middleware(['auth', 'admin']);

Route::get('product_details/{id}',[HomeController::class,'product_details'])->
middleware(['auth','verified']);

Route::get('shop',[HomeController::class,'shop']);

Route::get('add_cart/{id}',[HomeController::class,'add_cart'])->
middleware(['auth','verified']);

Route::get('mycart',[HomeController::class,'mycart'])->
middleware(['auth','verified']);

Route::get('remove_cart/{id}',[HomeController::class,'remove_cart'])->
middleware(['auth','verified']);

Route::post('confirm_order',[HomeController::class,'confirm_order'])->
middleware(['auth','verified']);

Route::get('view_order',[AdminController::class,'view_order'])->
middleware(['auth','admin']);

Route::get('on_the_way/{id}',[AdminController::class,'on_the_way'])->
middleware(['auth','admin']);

Route::get('delivered/{id}',[AdminController::class,'delivered'])->
middleware(['auth','admin']);

Route::get('print_pdf/{id}',[AdminController::class,'print_pdf'])->
middleware(['auth','admin']);

Route::get('myorders',[HomeController::class,'myorders'])->
middleware(['auth','verified']);


Route::get('why',[HomeController::class,'why']);


Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/admin/contacts', [ContactController::class, 'index'])->middleware('auth')->name('admin.contacts');

Route::get('/admin_home', [AdminController::class, 'admin_home'])->name('admin.home');