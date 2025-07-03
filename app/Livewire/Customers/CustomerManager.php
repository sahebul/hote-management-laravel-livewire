<?php

namespace App\Livewire\Customers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;

class CustomerManager extends Component
{
    use WithPagination;
    public function render()
    {
        $customer=Customer::paginate(10);
        return view('livewire.customers.customer-manager',[
            'customers'=>$customer
        ]
        )->layout('layouts.app');
    }
    public function delete($id){
        Customer::find($id)->delete();
         $this->dispatch('show-toast', message: 'Customer deleted successfully!');
    }


}
