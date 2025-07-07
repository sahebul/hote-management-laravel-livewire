<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Room</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            New Room
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
                    <div class="card-title">New Room</div>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Room Number</label>
                            <input type="number" class="form-control" wire:model="form.room_number">
                            @error('form.room_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Floor</label>
                            <input type="number" class="form-control" wire:model="form.floor">
                            @error('form.floor') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Room Type</label>
                         
                            <select class="form-select" wire:model="form.room_type_id">
                                <option value="">Select Room Type</option>
                                @foreach($roomTypes as $roomType)
                                    <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                @endforeach
                            </select>
                            @error('form.room_type_id') <span class="text-danger">{{ $message }}</span> @enderror
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