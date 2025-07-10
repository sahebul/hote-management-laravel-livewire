<?php


use App\Livewire\Booking\BookingCreate;
use App\Livewire\Booking\BookingDetail;
use App\Livewire\Booking\BookingList;
use App\Livewire\Customers\CreateCustomer;
use App\Livewire\Customers\CustomerManager;
use App\Livewire\Guest\CreateGuest;
use App\Livewire\Guest\GuestList;
use App\Livewire\Room\CreateRoom;
use App\Livewire\Room\CreateRoomType;
use App\Livewire\Room\RoomList;
use Illuminate\Support\Facades\Route;

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
// Route::get('/rooms', RoomManager::class)->middleware('auth');
Route::middleware('auth')->group(function(){
    Route::get('/bookings',BookingList::class)->name('bookings.list');
    Route::get('/bookings/create',BookingCreate::class)->name('bookings.create');
    Route::get('/bookings/edit/{id}', BookingCreate::class)->name('bookings.edit');
    Route::get('/bookings/detail/{id}', BookingDetail::class)->name('bookings.detail');
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

     //rooms
    Route::get('/rooms',RoomList::class)->name('rooms.list');
    Route::get('/rooms/create',CreateRoom::class)->name('rooms.create');
    Route::get('/rooms/edit/{id}', CreateRoom::class)->name('rooms.edit');


});

require __DIR__.'/auth.php';
