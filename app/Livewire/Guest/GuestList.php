<?php

namespace App\Livewire\Guest;

use App\Models\Guest;
use Livewire\Component;
use Livewire\WithPagination;

class GuestList extends Component
{
    use WithPagination;
    public function render()
    {
        $guests=Guest::paginate(10);
        return view('livewire.guest.guest-list',[
            'guests'=>$guests
        ]
        )->layout('layouts.app');
    }
    public function delete($id){
        Guest::find($id)->delete();
         $this->dispatch('show-toast', message: 'Guest deleted successfully!');
    }


}
