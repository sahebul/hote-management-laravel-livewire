<?php

namespace App\Livewire\Room;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
class CreateRoom extends Component
{
     use WithFileUploads;
    public $form =[];
    public $editId=null;
    protected $validationAttributes = [
            'form.room_number' => 'room number',
            'form.floor' => 'floor',
            'form.room_type_id' => 'room type',
            // 'form.id_proof' => 'id proof'
            // Add more fields as needed...
        ];

    public function render()
    {       

            $roomTypes = RoomType::all();
            return view('livewire.room.create-room', compact('roomTypes'))->layout('layouts.app');
    }
    public function mount($id = null)
    {
        //The mount() method runs automatically when the component is initialized/rendered.
        //it handle the edit functionality 
        if ($id) {
            $this->editId = $id;
            $room = Room::findOrFail($id);
            $this->form = $room->toArray();
           
        }
    }
    public function save(){
        
            $this->validate([
                'form.room_number'=>[
                    'required',
                    'numeric',
                     Rule::unique('rooms', 'room_number')->ignore($this->editId),
                ],
                'form.floor'=>[
                    'required',
                    'numeric'],
                'form.room_type_id'=>'required'
            ]);

            if($this->editId){
                    $room=Room::findOrFail($this->editId);
                  
                    $room->update($this->form);
                    $this->dispatch('show-toast', message: 'Room updated successfully!');
            }else{
                 

                    Room::create($this->form );
                    $this->dispatch('show-toast',message:"Room added successfully");
            }
            $this->reset('form', 'editId');
            return redirect()->route('rooms.list');
    }

            
}

