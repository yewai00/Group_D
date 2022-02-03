<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Dao\CustDaoInterface;
use App\Contracts\Services\CustServiceInterface;

class CustService implements CustServiceInterface
{

    private $pizzaDao;

    /**
     * Class Constructor
     * @param CustDaoInterface
     * @return
     */
    public function __construct(CustDaoInterface $custDaoInterface)
    {
        $this->custDao = $custDaoInterface;
    }

    /**
     * get pizza list
     */
    public function getPizzasList()
    {
        return $this->custDao->getPizzasList();
    }

    /**
     * get categories list
     */
    public function getCategoriesList()
    {
        return $this->custDao->getCategoriesList();
    }

    /**
     * get pizza detail
     * @param $id
     */
    public function getPizzaDetail($id)
    {
        return $this->custDao->getPizzaDetail($id);
    }

    /**
     * to get pizza list by category
     * @param Request $request
     * @return pizza list
     */
    public function searchPizza(Request $request)
    {
        return $this->custDao->searchPizza($request);
    }

    /**
     * To send contact mail to admin
     * @param Request $request
     * @return message success or not
     */
    public function contactMail(Request $request)
    {
        $data=[
            "message"=>$request->message,
            "name"=>Auth::user()->name
        ];
        Mail::send('customer.contactMail', ['data' => $data], function ($message) use ($request) {
            $message->from(Auth::user()->email, Auth::user()->email);
            $message->to('nandaroo600@gmail.com', "Admin")->subject($request->subject);
        });
        return true;
    }

    /**
     * send email
     * @param $email
     * @param $orderLists
     */
    public function sendMail($email, $orderLists) {
        Mail::to($email)->send($orderLists);
    }
    
    /** 
     * store order
     */
    public function orderAdd()
    {
        return $this->custDao->orderAdd();
    }

    /**
     * store orderPizza detail
     */
    public function orderPizzaAdd($order_id, $pizza_id, $qty, $price)
    {
        return $this->custDao->orderPizzaAdd($order_id, $pizza_id, $qty, $price);
    }

    /**
     * show order history 
     * @param $id
     * 
     */
    public function orderHistory($id) {
        return $this->custDao->orderHistory($id);
    }

    /**
     * show order history detail
     * @param $id
     */
    public function orderHistoryDetail($id) {
        return $this->custDao->orderHistoryDetail($id);
    }

     /**
     * get total price of an order
     */
    public function getTotalPrice($id) {
        return $this->custDao->getTotalPrice($id);
    }
}
