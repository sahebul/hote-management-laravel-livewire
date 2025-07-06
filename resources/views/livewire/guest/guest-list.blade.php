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
                        <h3 class="card-title mb-0">Guest List</h3>
                        <a  href="{{ route('guests.create') }}" class="btn btn-primary btn-sm ms-auto">Add Guest</a>
                    </div>

                    <div class="card-body">
                        <div wire:loading wire:target="nextPage, previousPage, gotoPage" class="alert alert-info">
                            Loading guests, please wait...
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Id Proof</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guests as $guest)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $guest->name }}</td>
                                        <td>{{ $guest->phone }}</td>
                                        <td>{{ $guest->email }}</td>
                                        <td>{{ $guest->address }}</td>
                                        <td>
                                            @if ($guest->id_proof)
                                                <a href="{{ asset('storage/' . $guest->id_proof) }}" target="_blank">View File</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a  href="{{ route('guests.edit', $guest->id) }}" 
                                                class="badge text-bg-warning ">Edit</a>

                                            <button wire:click="delete({{ $guest->id }})"
                                                class="badge text-bg-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $guests->links() }}
                    </div>
                </div> <!-- /.card -->

            </div> <!-- /.col -->

        </div> <!--end::Row-->
        </div>
    </div>
</main>