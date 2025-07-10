<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use Livewire\Component;

class BookingDetail extends Component
{
    public $booking;

    function mount($id)
    {
        //get booking by id with guest and room details
        // Eager load guest and room relationships
        $this->booking = Booking::with(['guest', 'room'])->findOrFail($id);
        // $this->booking = Booking::findOrFail($id);
        // dd($this->booking);
    }
    public function render()
    {
         return view('livewire.booking.booking-detail')->layout('layouts.app');
    }
}
