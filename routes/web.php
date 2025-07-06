<?php

use App\Http\Controllers\RoomController;
use App\Livewire\Customers\CreateCustomer;
use App\Livewire\Customers\CustomerManager;
use App\Livewire\Guest\CreateGuest;
use App\Livewire\Guest\GuestList;
use App\Livewire\Room\CreateRoomType;
use App\Models\Guest;
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


    //room types
    Route::get('/room-types',CreateRoomType::class)->name('room-types.list');

     //guests
    Route::get('/guests',GuestList::class)->name('guests.list');
    Route::get('/guests/create',CreateGuest::class)->name('guests.create');
    Route::get('/guests/edit/{id}', CreateGuest::class)->name('guests.edit');

});

require __DIR__.'/auth.php';
