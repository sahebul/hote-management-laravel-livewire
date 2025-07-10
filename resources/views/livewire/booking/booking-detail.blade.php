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
                            Booking Detail
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
                            <h3 class="card-title mb-0">Booking Detail</h3>
                            <!-- <a  href="{{ route('bookings.list') }}" class="btn btn-primary btn-sm ms-auto">Back to List</a> -->
                        </div>

                        <div class="card-body">
                            <h5>Guest Information</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking->guest as $guest)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $guest->guestDetail->name }}</td>
                                            <td>{{ $guest->guestDetail->email }}</td>
                                            <td>{{ $guest->guestDetail->phone }}</td>
                                            <td>{{ $guest->guestDetail->address }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>


                            <h5>Room Information</h5>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Room Number</th>
                                        <th>Floor</th>
                                        <th>Room Type</th>
                                        <th>Price</th>
                                        <th>Capacity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking->room as $room)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $room->roomDetail->room_number }}</td>
                                            <td>{{ $room->roomDetail->floor }}</td>
                                            <td>{{ $room->roomDetail->roomType->name }}</td>
                                            <td>{{ $room->roomDetail->roomType->price }}</td>
                                            <td>{{ $room->roomDetail->roomType->capacity }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>


                            <h5>Booking Information</h5>


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Staff Name</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>1</td>
                                        <td>{{ $booking->staff_id }}</td>
                                        <td>{{ $booking->check_in }}</td>
                                        <td>{{ $booking->check_out }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>{{ $booking->total_amount }}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="float-end">
                                <a href="{{ route('bookings.list') }}" class="btn btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div> <!-- /.card -->

                </div> <!-- /.col -->

            </div> <!--end::Row-->
        </div>
    </div>
</main>