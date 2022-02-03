<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;



/**
 * Interface for Data Accessing Object of Order
 */
interface OrderDaoInterface
{
    /**
     * To get order list
     * @param
     * @return order list
     */
    public function getAllOrders();

    /**
     * get rider list
     * @return object $rider
     */
    public function getRidersList();

     /**
     * To define rider for order
     * @param Request $request
     * @return true
     */
    public function defineRider(Request $request);

    /**
     * To show order detail
     * @param $id
     * @return view
     */
    public function orderDetail($id);

    /**
     * to get net price for specific order
     * @param order_id
     * @return net_price
     */
    public function getNetPriceByOrderId($id);

     /**
     * To search data from order list
     * @param $searchKey
     * @return order list
     */
    public function search(Request $request);
}
