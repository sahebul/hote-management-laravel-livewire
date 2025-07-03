<div class="card card-info card-outline mb-4"> 
    <div class="card-header">
        <div class="card-title">New Booking</div>
    </div>

    <form wire:submit.prevent="save">
        <div class="card-body"> 
            <div class="row g-3">
                <div class="col-md-6"> 
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" wire:model="form.first_name">
                    @error('form.first_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div> 

                <div class="col-md-6"> 
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" wire:model="form.last_name">
                </div> 

                <div class="col-md-6"> 
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" wire:model="form.city">
                </div> 

                <div class="col-md-6"> 
                    <label class="form-label">State</label>
                    <input type="text" class="form-control" wire:model="form.state">
                </div> 

                <div class="col-md-6"> 
                    <label class="form-label">Zip</label>
                    <input type="text" class="form-control" wire:model="form.zip">
                </div> 

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" wire:model="form.agree"> 
                        <label class="form-check-label">Agree to terms and conditions</label>
                    </div>
                </div> 
            </div> 
        </div> 

        <div class="card-footer">
            <button class="btn btn-info" type="submit">Submit</button>
        </div>
    </form>
</div> 
