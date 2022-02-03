<?php

namespace App\Services;


//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Contracts\Dao\OrderDaoInterface;
use App\Contracts\Services\OrderServicesInterface;

class OrderServices implements OrderServicesInterface
{
    private $orderDao;

    /**
     * Class Constructor
     * @param OrderDaoInterface
     * @return
     */
    public function __construct(OrderDaoInterface $orderDaoInterface)
    {
        $this->orderDao = $orderDaoInterface;
    }

    /**
     * To get order list
     * @param
     * @return order list
     */
    public function getAllOrders()
    {
        return $this->orderDao->getAllOrders();
    }

    /**
     * get rider list
     * @return object $rider
     */
    public function getRidersList()
    {
        return $this->orderDao->getRidersList();
    }

    /**
     * To define rider for order
     * @param Request $request
     * @return true
     */
    public function defineRider(Request $request)
    {
        return $this->orderDao->defineRider($request);
    }

    /**
     * To show order detail
     * @param $id
     * @return view
     */
    public function orderDetail($id)
    {
        return $this->orderDao->orderDetail($id);
    }

    /**
     * to get net price for specific order
     * @param order_id
     * @return net_price
     */
    public function getNetPriceByOrderId($id)
    {
        return $this->orderDao->getNetPriceByOrderId($id);
    }

    /**
     * To search data from order list
     * @param $searchKey
     * @return order list
     */
    public function search(Request $request)
    {
        return $this->orderDao->search($request);
    }

    /**
     * To download order detail by id
     * @param order id
     * @return true
     */
    public function download($id)
    {
        $orders = $this->orderDao->orderDetail($id);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('Admin.Orders.download', ["orders" => $orders]);
        //$file_name='Order-ID:'.$id.'.pdf';
        return $pdf->download('order.pdf');
    }
}
