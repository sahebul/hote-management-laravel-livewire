<?php

namespace App\Livewire\Room;

use App\Models\RoomType;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Livewire\Component;

class CreateRoomType extends Component
{
    public $editId=null;
    public $form=[];
    public function render()
    {
        $rooms_types = RoomType::all();
        return view('livewire.room.create-room-type',['rooms_types'=>$rooms_types])->layout('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'form.name' => 'required',
            'form.description' => 'required',
            'form.price' => 'required|integer',
            'form.capacity' => 'required|integer',
        ]);

        if ($this->editId) {
            $roomType = RoomType::find($this->editId);
            $roomType->update($this->form);
            $this->dispatch('show-toast', message: 'Room Type updated successfully!');
        } else {
            RoomType::create($this->form);
             $this->dispatch('show-toast', message: 'Room Type added successfully!');
        }

        $this->reset('form', 'editId');
    }
    public function edit($id)
    {
        $roomType = RoomType::find($id);
        $this->editId = $roomType->id;
        $this->form = [
            'name' => $roomType->name,
            'description' => $roomType->description,
            'price' => $roomType->price,
            'capacity' => $roomType->capacity,
        ];
    }
    public function delete($id)
    {
        $roomType = RoomType::find($id);
        if ($roomType) {
            $roomType->delete();
        }
    }  
    
    // protected $validationAttributes=[
    //     'form.name' => 'name',
    //     'form.description' => 'description',
    //     'form.price' => 'price',
    //     'form.capacity' => 'capacity',
    //     // Add more fields as needed...
    // ];
}