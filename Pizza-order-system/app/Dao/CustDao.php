<?php

namespace App\Dao;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\CustDaoInterface;
use App\Models\Order;
use App\Models\OrderPizza;
use Illuminate\Support\Facades\Auth;


class CustDao implements CustDaoInterface
{

    /**
     * get pizza list
     * @return pizza list
     */
    public function getPizzasList()
    {
        return Pizza::paginate(6);
    }

    /**
     * get categories list
     * @return category list
     */
    public function getCategoriesList()
    {
        return Category::all();
    }

    /**
     * get pizza detail
     * @return pizza detail
     */
    public function getPizzaDetail($id)
    {
        return Pizza::find($id);
    }

    /**
     * to get pizza list by category
     * @param Request $request
     * @return pizza list
     */
    public function searchPizza(Request $request)
    {
        $query = DB::table('pizzas')->select('pizzas.*');
        $category_id = $request->category_id;
        $name = $request->name;
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        if ($category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        $pizzas = $query->paginate(6);
        return $pizzas;
    }

    /**
     * store order table
     */
    public function orderAdd()
    {
        $user_id = Auth::user()->id;
        $rider_id = 1;
        $order = Order::create([
            'user_id' => $user_id,
        ]);
        return $order;
    }

    /**
     * store orderPizza detail in orderPizza table
     */
    public function orderPizzaAdd($order_id, $pizza_id, $qty, $price)
    {
        $orderPizza = OrderPizza::create([
            'order_id' => $order_id,
            'pizza_id' => $pizza_id,
            'quantity' => $qty,
            'price' => $price,
        ]);
        return $orderPizza;
    }
}
