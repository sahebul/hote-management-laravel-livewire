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
                            Room Type
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- body card list here -->

            <h2 class="text-xl font-bold mb-4">Room Type</h2>
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" wire:model="form.name" placeholder="Room Name" class="form-control">
                        @error('form.name')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <input type="text" wire:model="form.capacity" placeholder="Room Capacity" class="form-control">
                        @error('form.capacity')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="mb-4">
                <div class="row">

                    <div class="col-md-3">
                        <input type="number" wire:model="form.price" placeholder="Price" class="form-control">
                        @error('form.price')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model="form.description" placeholder="Description" class="form-control">
                        @error('form.description')
                            <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
                    </div>
                    <div class="col-md-3">
                        <button wire:click="save" class="btn btn-primary">
                            {{ $editId ? 'Update Room Type' : 'Add Room Type' }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Room Type</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Room Name</th>
                                        <th>Room Capacity</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rooms_types as $room)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $room->name }}</td>
                                            <td>{{ $room->capacity }}</td>
                                            <td>{{ $room->price }}</td>
                                            <td>{{ $room->description }}</td>
                                            <td>
                                                <button wire:click="edit({{ $room->id }})"
                                                    class="badge text-bg-warning ">Edit</button>
                                                <button wire:click="delete({{ $room->id }})"
                                                    class="badge text-bg-danger">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
</main>