<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class AdminOrderComponent extends Component
{
    public function updateOrderStatus($order_id,$status){
        $order = Order::find($order_id);
        $order->status = $status;
        if($status == "delivered"){
            $order->delivered_date = DB::raw('CURRENT_DATE');
        }elseif($status == "canceled"){
            $order->canceled_date = DB::raw('CURRENT_DATE');
        }
        $order->save();
        $this->dispatchBrowserEvent('toastr',['type' => 'Success','message' => 'Order status has been updated successfully!']);
    }
    use WithPagination;
    public function render()
    {
        $orders = Order::orderBy('created_at','DESC')->paginate(12);
        return view('livewire.admin.admin-order-component',compact('orders'))->layout('layouts.base');
    }

    public function paginationView()
    {
        return 'pagination-links';
    }
}
