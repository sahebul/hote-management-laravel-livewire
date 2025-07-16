<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Payment</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            New Payment
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
                    <div class="card-title">New Payment</div>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Bookings</label>
                            <select class="form-control" wire:model="form.booking_id">
                                    <option value="">Select</option>
                                    @foreach ($bookingList as $booking )
                                            <option value="{{ $booking->id }}">{{$booking->primaryGuest->guestDetail->name?? $booking->id}}</option>
                                    @endforeach
                                    
                            </select>
                            @error('form.payment_mode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>  

                        
                        <div class="col-md-6">
                            <label class="form-label">Amount</label>
                            <input type="text" class="form-control" wire:model="form.amount">
                            @error('form.amount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Payment Mode</label>
                            <select class="form-control" wire:model="form.payment_mode">
                                    <option value="">Select</option>
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="online">Online</option>
                            </select>
                            @error('form.payment_mode') <span class="text-danger">{{ $message }}</span> @enderror
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