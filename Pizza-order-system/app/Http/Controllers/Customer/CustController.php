<?php

namespace App\Http\Controllers\Customer;

use App\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\CustServiceInterface;
use App\Models\Order;
use App\Models\OrderPizza;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class CustController extends Controller
{
    /**
     * rider interface
     */
    private $custInterface;

    /**
     * Class Contructor
     * @param CustServiceInterface $riderServiceInterface
     * @return void
     */
    public function __construct(CustServiceInterface $custServiceInterface)
    {
        $this->custInterface = $custServiceInterface;
    }

    /**
     * show pizza list and categories
     * @return view with pizzas list and categories
     *
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.profile');
            }
        }
        $pizzas = $this->custInterface->getPizzasList();
        $categories = $this->custInterface->getCategoriesList();
        return  view('customer.index')
            ->with(['pizzas' => $pizzas, 'categories' => $categories]);
    }

    /**
     * show pizza detail
     * @param $id
     * @return view with pizza detail
     */
    public function pizzaDetail($id)
    {
        $pizza = $this->custInterface->getPizzaDetail($id);
        return view('customer.pizza-detail')->with(['pizza' => $pizza]);
    }

    /**
     * get cart item from the session
     * @param Request $request
     * @param $id
     */
    public function getAddToCart(Request $request, $id)
    {
        if (Auth::check()) {
            $pizza = $this->custInterface->getPizzaDetail($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($pizza, $pizza->id);
            $request->session()->put('cart', $cart);
            return redirect()->route('cart');
        }
    }

    /**
     * subtract one item from cart
     * @param Request $request
     * @param $id
     */
    public function minusItem(Request $request, $id)
    {
        $pizza = $this->custInterface->getPizzaDetail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->minus($pizza, $pizza->id);
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    /**
     * delete item from cart
     * @param $id
     */
    public function deleteItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $qty = $oldCart->items[$id]['qty'];
        $price = $oldCart->items[$id]['price'];
        unset($oldCart->items[$id]);
        $oldCart->totalQty = $oldCart->totalQty - $qty;
        $oldCart->totalPrice = $oldCart->totalPrice - $price;
        return redirect('cart');
    }


    /**
     * show cart
     */
    public function getCart()
    {
        if (Auth::check()) {
            if (!Session::has('cart')) {
                return view('customer.cart', ['pizzas' => null]);
            }
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            return view('customer.cart', ['pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        } else {
            return redirect()->route('cust');
        }
    }

    public function makeorder()
    {
        if (Auth::check()) {
            $session = Session::get('cart');
            $order = $this->custInterface->orderAdd();
            $order_id = $order->id;
            foreach (array_keys($session->items) as $i) {
                $pizza_id = $i;
                $qty = $session->items[$i]['qty'];
                $price = $session->items[$i]['price'];
                $this->custInterface->orderPizzaAdd($order_id, $pizza_id, $qty, $price);
            }
            $orderList = new Cart($session);
            $email = Auth::user()->email;
            $this->sendOrderMail($orderList, $email, $order_id);
            $this->sessionDestroy();
        }
        return redirect()->route('cust');
    }

    /**
     * To get pizza list by category
     * @param category id
     * @return pizza list
     */
    public function searchPizza(Request $request)
    {
        if ($request->category_id == null && $request->name == null && $request->min_price == null && $request->max_price == null) {
            return redirect('/#pizza-list');
        }
        $pizzas = $this->custInterface->searchPizza($request);
        $categories = $this->custInterface->getCategoriesList();
        return  view('customer.index')
            ->with(['pizzas' => $pizzas, 'categories' => $categories]);
    }

    /**
     * To send contact mail to admin
     * @param Request $request
     * @return message success or not
     */
    public function contactMail(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);

        $this->custInterface->contactMail($request);
        return redirect('/#contact-us')->with(['message' => 'The message has been sent to admin!']);
    }

    /**
     * send email to
     * @param string $email
     * return Object
     */
    public function sendOrderMail($orderList, $email, $order_id)
    {
        $orderLists = new OrderMail($orderList, $order_id);
        $this->custInterface->sendMail($email, $orderLists);
        return $orderLists;
    }

    /**
     * session destroy
     */
    public function sessionDestroy()
    {
        session()->forget('cart');
        return redirect('/');
    }
}
