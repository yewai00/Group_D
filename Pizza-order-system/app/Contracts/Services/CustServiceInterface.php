<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface CustServiceInterface
{

    /**
     * show pizza list
     */
    public function getPizzasList();

    /**
     * show categories list
     */
    public function getCategoriesList();

    /**
     * show pizza detail
     * @param $id
     */
    public function getPizzaDetail($id);

    /**
     * to get pizza list by category
     * @param Request $request
     * @return pizza list
     */
    public function searchPizza(Request $request);

    /**
     * To send contact mail to admin
     * @param Request $request
     * @return message success or not
     */
    public function contactMail(Request $request);

    /*
     * store order
     */
    public function orderAdd();

    /**
     * store orderPizza detail
     */
    public function orderPizzaAdd($order_id, $pizza_id, $qty, $price);

    /**
     * send email
     * @param $email
     * @param $orderLists
     */
    public function sendMail($email, $orderLists);


    /**
     * show order history
     * @param $id
     *
     */
    public function orderHistory($id);

    /**
     * show order history detail
     * @param $id
     */
    public function orderHistoryDetail($id);

    /**
     * get total price of an order
     */
    public function getTotalPrice($id);
}
