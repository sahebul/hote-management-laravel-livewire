<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentList extends Component
{
    use WithPagination;
    public function render()
    {
        $payments=Payment::paginate(10);
        return view('livewire.payments.payment-list',[
            'payments'=>$payments
        ]
        )->layout('layouts.app');
    }
    public function delete($id){
        Payment::find($id)->delete();
         $this->dispatch('show-toast', message: 'Payment deleted successfully!');
    }

}
