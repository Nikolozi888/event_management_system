<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SoldTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('index');

Route::get('/user/profile', [UserController::class, 'index'])->middleware('can:user')->name('user.profile');
Route::post('/user/soldTicket/destroy/{id}', [SoldTicketController::class, 'destroy'])->middleware('can:user')->name('soldTicket.destroy');

Route::get('/ticket/buy/{id}', [CheckoutController::class, 'ticketCreate'])->middleware('can:user')->name('ticket.create');
Route::post('/ticket/store', [CheckoutController::class, 'ticketStore'])->middleware('can:user')->name('ticket.store');

Route::get('category/{slug}', [CategoryController::class, 'show'])->middleware('can:user')->name('category.show');

Route::post('/forgot/password/{id}', [UserController::class, 'forgotPassword'])->middleware('can:user')->name('forgot.password');
Route::get('user/password/edit', [UserController::class, 'passwordEdit'])->middleware('auth')->name('password.edit');
Route::post('user/password/update', [UserController::class, 'passwordUpdate'])->middleware('auth')->name('password.update');

Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest')->name('login.handler');
Route::post('/logout', [SessionsController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [UserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [UserController::class, 'store'])->middleware('guest')->name('register.handler');

// Admin Routes
Route::middleware('can:admin')->group(function () {

    // User Management
    Route::get('/admin/profiles', [AdminController::class, 'profiles'])->name('admin.profiles');
    Route::get('/admin/profile/edit/{id}', [AdminController::class, 'profilesEdit'])->name('admin.profiles.edit');
    Route::post('/admin/profile/update/{id}', [AdminController::class, 'profilesUpdate'])->name('admin.profiles.update');


    // Category Management
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    // Venues Management
    Route::get('venues', [VenueController::class, 'index'])->name('venues.index');
    Route::get('venues/create', [VenueController::class, 'create'])->name('venues.create');
    Route::post('venues', [VenueController::class, 'store'])->name('venues.store');
    Route::get('venues/{venue}', [VenueController::class, 'show'])->name('venues.show');
    Route::get('venues/{venue}/edit', [VenueController::class, 'edit'])->name('venues.edit');
    Route::put('venues/{venue}', [VenueController::class, 'update'])->name('venues.update');
    Route::delete('venues/{venue}', [VenueController::class, 'destroy'])->name('venues.destroy');

    // Tickets Management
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    // Events Management
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});
