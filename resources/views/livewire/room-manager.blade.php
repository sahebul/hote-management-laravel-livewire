


<div class="p-4">


   

  <div class="container-fluid"> <!--begin::Row-->
    <h2 class="text-xl font-bold mb-4">Room Management1</h2>
    <div class="mb-4">
    <div class="row">
        <div class="col-md-3">
               <input type="text" wire:model="name" placeholder="Room Name" class="form-control">
                @error('name') 
                    <span class="text-danger text-sm">{{ $message }}</span> 
                @enderror
        </div>
         <div class="col-md-3">
               <input type="text" wire:model="number" placeholder="Room Number" class="form-control">
                @error('number') 
                    <span class="text-danger text-sm">{{ $message }}</span> 
                @enderror
        </div>
        <div class="col-md-3">
                <input type="text" wire:model="capacity" placeholder="Room Capacity" class="form-control"">
                  @error('capacity') 
                    <span class="text-danger text-sm">{{ $message }}</span> 
                @enderror
        </div>
    
    </div>
    </div>
    <div class="mb-4">
    <div class="row">
       
        <div class="col-md-3">
                <input type="number" wire:model="price" placeholder="Price" class="form-control"">
                  @error('price') 
                    <span class="text-danger text-sm">{{ $message }}</span> 
                @enderror
        </div>
        <div class="col-md-3">
                <input type="text" wire:model="description" placeholder="Description" class="form-control"">
                  @error('description') 
                    <span class="text-danger text-sm">{{ $message }}</span> 
                @enderror
        </div>
        <div class="col-md-3">
                  <button wire:click="save" class="btn btn-primary">
                     {{ $editId ? 'Update Room' : 'Add Room' }}
                  </button>
        </div>
    </div>
    </div>


                      
          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-header">
                  <h3 class="card-title">Room List</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div wire:loading wire:target="nextPage, previousPage, gotoPage" class="alert alert-info">
                        Loading rooms, please wait...
                    </div>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Room Number</th> 
                        <th>Room Name</th>
                        <th>Room Capacity</th>
                        <th>Price</th>
                        <th>Description</th>  
                        <th>Availability</th>
                        <th >Actions</th>
                      </tr>
                    </thead>
                     <tbody>
                        @foreach($rooms as $room)
                            <tr class="align-middle">
                                <td >{{ $loop->iteration }}</td>
                                <td >{{ $room->number }}</td>
                                <td >{{ $room->name }}</td>
                                <td >{{ $room->capacity }}</td>
                                <td >{{ $room->price }}</td>
                                <td >{{ $room->description }}</td>
                                <td >{{ $room->status }}</td>
                                <td >
                                    <button wire:click="edit({{ $room->id }})" class="badge text-bg-warning ">Edit</button>
                                    <button wire:click="delete({{ $room->id }})" class="badge text-bg-danger">Delete</button>
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
        </div> <!--end::Container-->
        </div>