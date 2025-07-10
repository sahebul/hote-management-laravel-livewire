<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Booking</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            New Booking
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">New Booking</div>
                </div>

                <div class="card-body">
                  
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Check-in Date</label>
                            <input type="date" class="form-control" wire:model="form.check_in">
                            @error('form.check_in') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Check-out Date</label>
                            <input type="date" class="form-control" wire:model="form.check_out">
                            @error('form.check_out') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" wire:model="form.status">
                                <option value="">Select Status</option>
                                <option value="booked">Booked</option>
                                <option value="checked_in">Checked In</option>
                                <option value="checked_out">Checked Out</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            @error('form.status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Total Amount</label>
                            <input type="text" class="form-control" wire:model="form.total_amount">
                            @error('form.total_amount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        
                    </div>
                    <div class="row">

                     <div class="col-md-6 mb-4">
                        <label for="guestSelect" class="block mb-1">Select Guest</label>
                        <select wire:model="selectedGuestId" id="guestSelect" class="col-md-8 border rounded p-2">
                            <option value="">-- Choose a guest --</option>
                            @foreach($guests as $guest)
                                <option value="{{ $guest->id }}">{{ $guest->name }}</option>
                            @endforeach
                        </select>
                        <button wire:click="addGuest" class="ml-2 btn btn-primary text-white px-3 py-1 rounded">
                            Add
                        </button>
                    </div>

                     <div class="col-md-6 mb-4">
                        <label for="roomSelect" class="block mb-1">Select Room</label>
                        <select wire:model="selectedRoomId" id="roomSelect" class="col-md-8 border rounded p-2">
                            <option value="">-- Choose a room --</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                            @endforeach
                        </select>
                        <button wire:click="addRoom" class="ml-2 btn btn-primary text-white px-3 py-1 rounded">
                            Add
                        </button>
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div>
                                <h5 class="font-semibold mb-2">Selected Guests:</h5>
                                @foreach($selectedGuests as $guest)
                                    <div class="flex items-center justify-between mb-2 border p-2 rounded">
                                        <span>{{ $guest['name'] }}</span>
                                        <button wire:click="removeGuest({{ $guest['id'] }})" class="btn btn-danger text-white px-2 py-1 rounded">
                                            Remove
                                        </button>
                                    </div>
                                @endforeach

                                @if(empty($selectedGuests))
                                    <p>No guests selected.</p>
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-md-6 mb-4">
                            <div>
                                <h5 class="font-semibold mb-2">Selected Rooms:</h5>
                                @foreach($selectedRooms as $room)
                                    <div class="flex items-center justify-between mb-2 border p-2 rounded">
                                        <span>{{ $room['number'] }}</span>
                                        <button wire:click="removeRoom({{ $room['id'] }})" class="btn btn-danger text-white px-2 py-1 rounded">
                                            Remove
                                        </button>
                                    </div>
                                @endforeach

                                @if(empty($selectedRooms))
                                    <p>No rooms selected.</p>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    
                    

                      

                </div>

                <div class="card-footer">
                    <button class="btn btn-primary" wire:click="save">
                        {{ $this->editId ? 'Update':'Save' }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</main>