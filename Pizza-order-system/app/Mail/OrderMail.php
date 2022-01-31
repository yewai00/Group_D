<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private $orderLists;
    private $order_id;

    /**
     * Create a new message instance.
     * @param $orderLists
     * @param $order_id
     * @return void
     */
    public function __construct($orderLists, $order_id)
    {
        $this->orderLists = $orderLists;
        $this->order_id = $order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@foodOrderApp.com')
        ->markdown('customer.order-mail-cust')
        ->with(['orderLists' => $this->orderLists,
                'order_id' => $this->order_id]);
    }
}
