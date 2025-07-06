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
                            New Guest
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
                    <div class="card-title">New Guest</div>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" wire:model="form.name">
                            @error('form.name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Mobile Number</label>
                            <input type="number" class="form-control" wire:model="form.phone">
                            @error('form.phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" wire:model="form.email">
                            @error('form.email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" wire:model="form.address">
                            @error('form.address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Id Proof</label>
                            <input type="file" class="form-control" wire:model="file">
                            @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                            @if ($existingFile)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $existingFile) }}" target="_blank">View File</a>
                                </div>
                            @endif
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