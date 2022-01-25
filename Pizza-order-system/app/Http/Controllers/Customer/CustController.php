<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\CustServiceInterface;

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
    public function index() {
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.profile');
            }
        }
        $pizzas = $this->custInterface->getPizzasList();
        $categories = $this->custInterface->getCategoriesList();
        return  view('customer.index')
            ->with(['pizzas' => $pizzas,'categories' => $categories]);
    }

    /**
     * show pizza detail
     * @param $id
     * @return view with pizza detail
     */
    public function pizzaDetail($id) {
        $pizza = $this->custInterface->getPizzaDetail($id);
        return view('customer.pizza-detail')->with(['pizza' => $pizza]);
    }

    /**
     * show cart info
     *
     */
    public function cart() {
        return view('customer.cart');
    }
}
