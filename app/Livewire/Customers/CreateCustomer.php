<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;

class CreateCustomer extends Component
{
   
    public $form =[];
    public $editId=null;

    protected $validationAttributes = [
            'form.name' => 'name',
            'form.mobile_number' => 'mobile number',
            'form.email' => 'email address',
            'form.address' => 'address'
            // Add more fields as needed...
        ];

    public function render()
    {
            return view('livewire.customers.create-customer')->layout('layouts.app');
    }
    public function mount($id = null)
    {
        //The mount() method runs automatically when the component is initialized/rendered.
        //it handle the edit functionality 
        if ($id) {
            $this->editId = $id;
            $customer = Customer::findOrFail($id);
            $this->form = $customer->toArray();
        }
    }
    public function save(){
            $this->validate([
                'form.name'=>'required',
                'form.mobile_number'=>[
                    'required',
                    'numeric',
                    'digits:10',
                    Rule::unique('customers','mobile_number')->ignore($this->editId),
                ],
                'form.email'=>'email',
                'form.address'=>'required'
            ]);

            if($this->editId){
                    $customer=Customer::findOrFail($this->editId);
                    $customer->update($this->form);
                    $this->dispatch('show-toast', message: 'Customer updated successfully!');
            }else{
                    Customer::create($this->form);
                    $this->dispatch('show-toast',message:"Customer added succesfully");
            }
            return redirect()->route('customers.list');
    }

            
}

