<?php

namespace App\Livewire\Room;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class RoomList extends Component
{
    use WithPagination;
    public function render()
    {
        $rooms=Room::paginate(10);
        return view('livewire.room.room-list',[
            'rooms'=>$rooms
        ]
        )->layout('layouts.app');
    }
    public function delete($id){
        Room::find($id)->delete();
         $this->dispatch('show-toast', message: 'Room deleted successfully!');
    }


}
