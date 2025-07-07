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
                            Room List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title mb-0">Room List</h3>
                        <a  href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm ms-auto">Add Room</a>
                    </div>

                    <div class="card-body">
                        <div wire:loading wire:target="nextPage, previousPage, gotoPage" class="alert alert-info">
                            Loading rooms, please wait...
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Room Number</th>
                                    <th>Floor</th>
                                    <th>Room Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $room->room_number }}</td>
                                        <td>{{ $room->floor }}</td>
                                        <td>{{ $room->roomType->name }}</td>

                                        <td>
                                            <a  href="{{ route('rooms.edit', $room->id) }}" 
                                                class="badge text-bg-warning ">Edit</a>

                                            <button wire:click="delete({{ $room->id }})"
                                                class="badge text-bg-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $rooms->links() }}
                    </div>
                </div> <!-- /.card -->

            </div> <!-- /.col -->

        </div> <!--end::Row-->
        </div>
    </div>
</main>