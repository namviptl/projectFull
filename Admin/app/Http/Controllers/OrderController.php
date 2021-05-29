<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Traits\DeleteModelTrait;

class OrderController extends Controller
{

    use  DeleteModelTrait;

    private $order, $orderDetail;

    public function __construct(Order $order, DetailOrder $detailOrder)
    {
    	$this->order = $order;
    	$this->detailOrder = $detailOrder;
    }
    public function index()
    {
    	$orders = $this->order->latest()->paginate(10);
    	return view('admin.order.index', compact('orders'));
    }

    public function detail($id)
    {

    	$detail =  $this->detailOrder::with('product', 'order')->where('order_id', $id)->get();
    	$oneDetail =  $this->detailOrder::with('product', 'order')->where('order_id', $id)->get();
    	$oneDetail =  $oneDetail[0];
    	$user = $this->order::with('user')->where('id', $id)->limit(1)->get();
    	$user = $user[0];
    	$total = 0;
    	return view('admin.order.detail', compact('detail', 'oneDetail', 'user'));
    }

    public function delete($id)
    {
    	return $this->deleteModelTrait($id, $this->order);
    }
}
