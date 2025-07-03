<?php
namespace App\Livewire\Booking;
use livewire\Component;
use App\Models\Customer;
class BookingCreate extends Component
{
    public $form=[];
    public function save(){
        $this->validate([
            'form.name'=>'required'
        ]);
        Customer::create($this->form);
        $this->dispatch('show-toast',message:'Booking Added Successfully');
        return redirect()->route('bookings.list');

    }
    public function render(){
        // return view('livewire.booking.form')->layout('layouts.app');
        return view('livewire.booking.booking-create')->layout('layouts.app');
    }

}