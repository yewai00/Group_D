<?php

namespace App\Dao;

use App\Models\Order;
use App\Models\Pizza;
use App\Models\Rider;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\OrderDaoInterface;
use App\Models\OrderPizza;

class OrderDao  implements OrderDaoInterface
{
    /**
     * To get order list
     * @param
     * @return order list
     */
    public function getAllOrders()
    {
        $orders = Order::join('users', 'users.id', 'orders.user_id')
            ->leftJoin('riders', 'riders.id', 'orders.rider_id')
            ->join('order_pizzas', 'orders.id', 'order_pizzas.order_id')
            ->select('orders.*', 'riders.name as rider_name', DB::raw('sum(price) as net_price'))
            ->groupBy('orders.id')
            ->orderBy("orders.id", "desc")
            ->paginate(8);
        return $orders;
    }

    /**
     * get rider list
     * @return object $rider
     */
    public function getRidersList()
    {
        $riders = Rider::all();
        return $riders;
    }

    /**
     * To define rider for order
     * @param Request $request
     * @return true
     */
    public function defineRider(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->rider_id = $request->rider_id;
        $order->save();
        return true;
    }

    /**
     * To show order detail
     * @param $id
     * @return view
     */
    public function orderDetail($id)
    {
        $order = Order::where('orders.id', $id)
            ->join('order_pizzas', 'orders.id', 'order_pizzas.order_id')
            ->join('pizzas', 'pizzas.id', 'order_pizzas.pizza_id')
            ->leftJoin('riders', 'riders.id', 'orders.rider_id')
            ->select('orders.*', 'order_pizzas.*', 'pizzas.name as pizza_name', 'order_pizzas.pizza_id', 'riders.name as rider_name')
            ->orderBy('order_pizzas.pizza_id')
            ->get();

        return $order;
    }

    /**
     * to get net price for specific order
     * @param order_id
     * @return net_price
     */
    public function getNetPriceByOrderId($id)
    {
        return OrderPizza::where('order_id', $id)
            ->sum('price');
    }

    /**
     * To search data from order list
     * @param $searchKey
     * @return order list
     */
    public function search(Request $request)
    {
        $key = $request->key;
        $orders = Order::join('users', 'users.id', 'orders.user_id')
            ->leftJoin('riders', 'riders.id', 'orders.rider_id')
            ->join('order_pizzas', 'orders.id', 'order_pizzas.order_id')
            ->select('orders.*', 'riders.name as rider_name', DB::raw('sum(price) as net_price'))
            ->orwhere('users.name', 'like', '%' . $key . '%')
            ->orwhere('riders.name', 'like', '%' . $key . '%')
            ->groupBy('orders.id')
            ->orderBy("orders.id", "desc")
            ->paginate(8);
        return $orders;
    }
}
