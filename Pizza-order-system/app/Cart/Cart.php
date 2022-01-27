<?php 

namespace App\Cart;

class Cart {
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item , $id) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        if($item['buy_one_get_one']) {
            $storedItem['qty'] = $storedItem['qty'] + 2;
            $storedItem['price'] = $item->price * ($storedItem['qty'] / 2);
            $this->items[$id] = $storedItem;
            $this->totalQty = $this->totalQty + 2;  
        }
        else {
            $storedItem['qty']++;
            $storedItem['price'] = $item->price * $storedItem['qty'];
            $this->items[$id] = $storedItem;
            $this->totalQty++;
        }
        $this->totalPrice += $item->price;
    }

    public function minus($item , $id) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        if($storedItem['qty'] > 1) {
            if($item['buy_one_get_one']) {
                if($storedItem['qty'] > 2) {
                    $storedItem['qty'] = $storedItem['qty'] - 2;
                    $storedItem['price'] = $item->price * ($storedItem['qty'] / 2);
                    $this->items[$id] = $storedItem;
                    $this->totalQty = $this->totalQty - 2;
                    $this->totalPrice -= $item->price;
                }
            }      
            else {
                $storedItem['qty']--;
                $storedItem['price'] = $item->price * $storedItem['qty'];
                $this->items[$id] = $storedItem;
                $this->totalQty--;
                $this->totalPrice -= $item->price;
            }  
        }
    }
}
?>