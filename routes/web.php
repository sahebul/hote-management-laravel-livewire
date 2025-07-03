<?php

use App\Http\Controllers\RoomController;
use App\Livewire\Customers\CreateCustomer;
use App\Livewire\Customers\CustomerManager;
use Illuminate\Support\Facades\Route;
use App\Livewire\RoomManager;
use App\Livewire\Booking\BookingManger;
use App\Livewire\Booking\BookingCreate;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


//room

// Route::get('/rooms',[RoomController::class,'index']);
// Route::post('/rooms',[RoomController::class,'store']);
Route::get('/rooms', RoomManager::class)->middleware('auth');
Route::middleware('auth')->group(function(){
    Route::get('/bookings',BookingManger::class)->name('bookings.list');
    Route::get('/bookings/create',BookingCreate::class)->name('bookings.create');

    //customers 
    Route::get('/customers',CustomerManager::class)->name('customers.list');
    Route::get('/customers/create',CreateCustomer::class)->name('customers.create');
    Route::get('/customers/edit/{id}', CreateCustomer::class)->name('customers.edit');
});

require __DIR__.'/auth.php';
