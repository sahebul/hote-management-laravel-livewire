<?php

namespace App\Livewire\Payments;

use App\Models\Booking;
use App\Models\Payment;
use Livewire\Component;
class CreatePayment extends Component
{

    public $form =[];
    public $editId=null;
    protected $validationAttributes = [
            'form.amount' => 'amount',
            'form.payment_date' => 'Payment Date',
            'form.payment_mode' => 'Payment Mode'
            // Add more fields as needed...
        ];

    public function render()
    {
            $bookingList=Booking::with(['primaryGuest'])->get();
          
            return view('livewire.payments.create-payment',['bookingList'=>$bookingList])->layout('layouts.app');
    }
    public function mount($id = null)
    {
        //The mount() method runs automatically when the component is initialized/rendered.
        //it handle the edit functionality 
        if ($id) {
            $this->editId = $id;
            $guest = Payment::findOrFail($id);
            $this->form = $guest->toArray();
        }
    }
    public function save(){
            $this->validate([
                'form.amount'=>'required|numeric',
                'form.payment_mode'=>'required'
            ]);

            if($this->editId){
                    $guest=Payment::findOrFail($this->editId);
                   
                    $guest->update($this->form);
                    $this->dispatch('show-toast', message: 'Payment updated successfully!');
            }else{

                    Payment::create($this->form + ['payment_date'=>date('Y-m-d H:i:s')]);
                    $this->dispatch('show-toast',message:"Payment added successfully");
            }
            $this->reset('form', 'editId');
            return redirect()->route('payments.list');
    }

            
}

