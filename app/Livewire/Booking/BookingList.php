<?php

namespace App\Livewire\Booking;

use Livewire\Component;
use App\Models\Booking;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
class BookingList extends Component
{
    use WithPagination;


    public function render()
    {
        $bookings = Booking::paginate(10);

        return view('livewire.booking.booking-list', [
            'bookings' => $bookings
        ])->layout('layouts.app');
    }

    public function delete($id)
    {
        Booking::find($id)->delete();
        $this->dispatch('show-toast', message: 'Booking deleted successfully!');
    }

}
