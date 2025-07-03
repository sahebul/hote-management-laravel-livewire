<?php

namespace App\Livewire\Booking;

use Livewire\Component;
use App\Models\Room;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
class BookingManger extends Component
{
    use WithPagination;
  
    public $form=[];
    public $editId = null;

    public function render()
    {
        $rooms = Room::paginate(10);

        return view('livewire.booking.booking-manager', [
            'rooms' => $rooms
        ])->layout('layouts.app');
    }

    public function edit($id)
    {
        $room = Room::find($id);

        $this->editId = $room->id;
        $this->form= $room->toArray();
      
    }
    public function save()
    {
        $this->validate([
            'form.number' => [
                'required',
                Rule::unique('rooms', 'number')->ignore($this->editId),
            ],
            'form.price' => 'required|integer',
            'form.capacity' => 'required',

        ]);
        if ($this->editId) {
            $room = Room::find($this->editId);
            $room->update( $this->form);

            $this->dispatch('show-toast', message: 'Room updated successfully!');
        } else {
            Room::create( $this->form);
            
            // $this->loadRooms();
            // Emit success event for toast

            $this->dispatch('show-toast', message: 'Room added successfully!');
        }
        $this->reset(['form','editId']);

    }
    public function delete($id)
    {
        Room::find($id)->delete();
        // $this->loadRooms();
        $this->reset(['form', 'editId']);
        $this->dispatch('show-toast', message: 'Room deleted successfully!');
    }

}
