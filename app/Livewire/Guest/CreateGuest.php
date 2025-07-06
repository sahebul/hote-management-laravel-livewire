<?php

namespace App\Livewire\Guest;

use App\Models\Guest;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
class CreateGuest extends Component
{
     use WithFileUploads;
    public $form =[];
    public $editId=null;
    public $file=null;
    public $existingFile = null; // To hold the existing file path when editing

    protected $validationAttributes = [
            'form.name' => 'name',
            'form.email' => 'email address',
            'form.phone' => 'phone',
            'form.address' => 'address',
            // 'form.id_proof' => 'id proof'
            // Add more fields as needed...
        ];

    public function render()
    {
            return view('livewire.guest.create-guest')->layout('layouts.app');
    }
    public function mount($id = null)
    {
        //The mount() method runs automatically when the component is initialized/rendered.
        //it handle the edit functionality 
        if ($id) {
            $this->editId = $id;
            $guest = Guest::findOrFail($id);
            $this->form = $guest->toArray();
            $this->existingFile = $guest->id_proof; // Keep the existing file path for editing
        }
    }
    public function save(){
            $this->validate([
                'form.name'=>'required',
                'form.phone'=>[
                    'required',
                    'numeric',
                    'digits:10',
                    Rule::unique('guests','phone')->ignore($this->editId),
                ],
                'form.email'=>'email',
                'form.address'=>'required',
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            if($this->editId){
                    $guest=Guest::findOrFail($this->editId);
                    // If a file is uploaded, store it and update the id_proof field
                    if ($this->file) {
                        $path = $this->file->store('uploads', 'public');
                        $this->form['id_proof'] = $path; // Update the id_proof field with the new file path
                        unlink(public_path('storage/' . $guest->id_proof)); // Delete the old file
                    } else {
                        $this->form['id_proof'] = $guest->id_proof; // Keep the existing file path if no new file is uploaded
                    }
                    $guest->update($this->form);
                    $this->dispatch('show-toast', message: 'Guest updated successfully!');
            }else{
                    $path = $this->file->store('uploads', 'public');

                    Guest::create($this->form + ['id_proof' => $path]);
                    $this->dispatch('show-toast',message:"Guest added successfully");
            }
            $this->reset('form', 'editId', 'file');
            return redirect()->route('guests.list');
    }

            
}

