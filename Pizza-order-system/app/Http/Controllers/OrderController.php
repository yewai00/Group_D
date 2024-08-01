<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Services\OrderServicesInterface;

class OrderController extends Controller
{
    private $orderInterface;

    /**
     * Class constructor
     * @param OrderServicesInterface
     * @return
     */
    public function __construct(OrderServicesInterface $orderServicesInterface)
    {
        $this->orderInterface = $orderServicesInterface;
    }

    /**
     * To show order list
     * @param
     * @return view with order list
     */
    public function orderList()
    {
        $orders = $this->orderInterface->getAllOrders();
        $riders = $this->orderInterface->getRidersList();
        return view('admin.orders.index')->with(['orders' => $orders, 'riders' => $riders]);
    }

    /**
     * To define rider for order
     * @param Request $request
     * @return true
     */
    public function defineRider(Request $request)
    {
        $request->validate([
            'rider_id' => 'required'
        ]);
        $this->orderInterface->defineRider($request);
        return redirect()->route('order-list');
    }

    /**
     * To show order detail
     * @param $id
     * @return view
     */
    public function orderDetail($id)
    {
        $order = $this->orderInterface->orderDetail($id);
        $net_price = $this->orderInterface->getNetPriceByOrderId($id);
        return view('admin.orders.detail')->with(['order' => $order, 'net_price' => $net_price]);
    }

    /**
     * To search data from order list
     * @param $searchKey
     * @return order list
     */
    public function search(Request $request)
    {
        $orders = $this->orderInterface->search($request);
        $riders = $this->orderInterface->getRidersList();
        return view('admin.orders.index')->with(['orders' => $orders, 'riders' => $riders]);
    }

    /**
     * To download order detail by id
     * @param order id
     * @return true
     */
    public function download($id)
    {
        $this->orderInterface->download($id);
        return back();
    }
}
