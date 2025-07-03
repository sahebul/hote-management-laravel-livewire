<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
class RoomManager extends Component
{
    use WithPagination;
    // public $rooms;
    public $number;
    public $price;
    public $description;
    public $capacity;
    public $name;
    public $editId = null;

    // public function mount(){
    //     $this->loadRooms();
    // }
    // public function loadRooms(){
    //     $this->rooms=Room::all();
    // }
    public function render()
    {
        $rooms = Room::paginate(10);

        return view('livewire.room-manager', [
            'rooms' => $rooms
        ])->layout('layouts.app');
    }

    public function edit($id)
    {
        $room = Room::find($id);

        $this->editId = $room->id;
        $this->number = $room->number;
        $this->price = intval($room->price) ;
        $this->description = $room->description;
        $this->capacity = $room->capacity;
        $this->name = $room->name;
    }
    public function save()
    {
        $this->validate([
            'number' => [
                'required',
                Rule::unique('rooms', 'number')->ignore($this->editId),
            ],
            'price' => 'required|integer',
            'capacity' => 'required',

        ]);
        if ($this->editId) {
            $room = Room::find($this->editId);
            $room->update([
                'number' => $this->number,
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'capacity' => $this->capacity
            ]);

            $this->dispatch('show-toast', message: 'Room updated successfully!');
        } else {
            Room::create([
                'number' => $this->number,
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'capacity' => $this->capacity
            ]);
            
            // $this->loadRooms();
            // Emit success event for toast

            $this->dispatch('show-toast', message: 'Room added successfully!');
        }
        $this->reset(['number', 'price', 'description','name', 'capacity', 'editId']);

    }
    public function delete($id)
    {
        Room::find($id)->delete();
        // $this->loadRooms();
          $this->reset(['number', 'price', 'description', 'capacity','name', 'editId']);
        $this->dispatch('show-toast', message: 'Room deleted successfully!');
    }

}
