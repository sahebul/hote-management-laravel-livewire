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
                            Booking List
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
                        <h3 class="card-title mb-0">Booking List</h3>
                        <a  href="{{ route('bookings.create') }}" class="btn btn-primary btn-sm ms-auto">Add Booking</a>
                    </div>

                    <div class="card-body">
                        <div wire:loading wire:target="nextPage, previousPage, gotoPage" class="alert alert-info">
                            Loading Booking, please wait...
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->check_in }}</td>
                                        <td>{{ $booking->check_out }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>{{ $booking->total_amount }}</td>
                                       
                                        <td>
                                            <a  href="{{ route('bookings.edit', $booking->id) }}" 
                                                class="badge text-bg-warning ">Edit</a>
                                            <a  href="{{ route('bookings.detail', $booking->id) }}" 
                                                class="badge text-bg-info ">Detail</a>

                                            <button wire:click="delete({{ $booking->id }})"
                                                class="badge text-bg-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $bookings->links() }}
                    </div>
                </div> <!-- /.card -->

            </div> <!-- /.col -->

        </div> <!--end::Row-->
        </div>
    </div>
</main>