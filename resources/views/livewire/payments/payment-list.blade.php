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
                            Payment List
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
                        <h3 class="card-title mb-0">Payment List</h3>
                        <a  href="{{ route('payments.create') }}" class="btn btn-primary btn-sm ms-auto">Add Payment</a>
                    </div>

                    <div class="card-body">
                        <div wire:loading wire:target="nextPage, previousPage, gotoPage" class="alert alert-info">
                            Loading Payment, please wait...
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Booking Name</th>
                                    <th>Booking Ref</th>
                                    <th>Amount</th>
                                    <th>Payment Mode</th>
                                    <th>Payment Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->booking->primaryGuest->guestDetail->name??$payment->booking->id }}</td>
                                        <td>{{ $payment->booking->booking_ref }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->payment_mode }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>
                                            <a  href="{{ route('payments.edit', $payment->id) }}" 
                                                class="badge text-bg-warning ">Edit</a>

                                            <button wire:click="delete({{ $payment->id }})"
                                                class="badge text-bg-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $payments->links() }}
                    </div>
                </div> <!-- /.card -->

            </div> <!-- /.col -->

        </div> <!--end::Row-->
        </div>
    </div>
</main>