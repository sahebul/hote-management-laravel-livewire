<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Guest</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Guest List
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
                        <h3 class="card-title mb-0">Customer List</h3>
                        <a  href="{{ route('customers.create') }}" class="btn btn-primary btn-sm ms-auto">Add Customer</a>
                    </div>

                    <div class="card-body">
                        <div wire:loading wire:target="nextPage, previousPage, gotoPage" class="alert alert-info">
                            Loading customers, please wait...
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->mobile_number }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>
                                            <a  href="{{ route('customers.edit', $customer->id) }}" 
                                                class="badge text-bg-warning ">Edit</a>
                                                
                                            <button wire:click="delete({{ $customer->id }})"
                                                class="badge text-bg-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $customers->links() }}
                    </div>
                </div> <!-- /.card -->

            </div> <!-- /.col -->

        </div> <!--end::Row-->
        </div>
    </div>
</main>