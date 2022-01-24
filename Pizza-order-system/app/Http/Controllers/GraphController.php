<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\Services\PizzaServicesInterface;

class GraphController extends Controller
{
    private $pizzaInterface;

    /**
     * Class constructor
     * @param PizzaServicesInterface
     * @return
     */
    public function __construct(PizzaServicesInterface $pizzaServicesInterface)
    {
        $this->pizzaInterface = $pizzaServicesInterface;
    }

    /**
     * To show pizza sales graph
     * @param
     * @return view with data
     */
    public function graph()
    {
        $data = $this->pizzaInterface->graph();
        return view('Admin.graph', $data);
    }
}
