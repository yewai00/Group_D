<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PizzasExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Services\PizzaServicesInterface;
use App\Contracts\Services\CategoryServicesInterface;

class PizzaController extends Controller
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
     * To redirect pizza list page
     * @param
     * @return view
     */
    public function pizzaList()
    {
        $pizzas = $this->pizzaInterface->getAllPizzasInfo();
        return view('Admin.Pizza.pizzaList')->with(['pizzas' => $pizzas]);
    }

    /**
     * To redirect pizza form to create new pizza
     * @param
     * @return view
     */
    public function showNewPizzaForm()
    {
        $categories = $this->pizzaInterface->getAllCategories();
        return view('Admin.Pizza.newPizza')->with(['categories' => $categories]);
    }

    /**
     * To create new pizza
     * @param Request $request
     * @return message success or not
     */
    public function submitNewPizzaForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpeg|max:2048',
            'category_id' => 'required',
            'price' => 'required',
            'buy_one_get_one' => 'required',
            'description' => 'required|max:1000'
        ]);

        $this->pizzaInterface->savePizza($request);
        return redirect()->route('admin.pizza.list')->with(['message' => 'The new pizza is successfully added!']);
    }

    /**
     * To show details info of pizza
     * @param $id
     * @return view
     */
    public function pizzaDetails($id)
    {
        $pizza = $this->pizzaInterface->getPizzaById($id);
        return view('Admin.Pizza.pizzaDetail')->with(['pizza' => $pizza]);
    }

    /**
     * To redirect pizza edit form
     * @param $id
     * @return
     */
    public function showEditPizzaForm($id)
    {
        $pizza = $this->pizzaInterface->getPizzaById($id);
        $categories = $this->pizzaInterface->getAllCategories();
        return view('Admin.Pizza.editPizza')->with(['pizza' => $pizza, 'categories' => $categories]);
    }

    /**
     * To edit pizz info
     * @param Request $request, $id
     * @return message success or not
     */
    public function submitEditPizzaForm(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:png,jpeg|max:2048',
            'category_id' => 'required',
            'price' => 'required',
            'buy_one_get_one' => 'required',
            'description' => 'required|max:1000'
        ]);
        $this->pizzaInterface->editPizza($request, $id);
        return redirect()->route('admin.pizza.list')->with(['message' => 'The pizza is successfully updated!']);
    }

    /**
     * To redirect to confirm delete pizzza
     * @param $id
     * @return
     */
    public function showDeletePizzaConfirm($id)
    {
        $pizza = $this->pizzaInterface->getPizzaById($id);
        return view('Admin.Pizza.deletePizza')->with(['pizza' => $pizza]);
    }

    /**
     * To delete pizza by id
     * @param $id
     * @return message success or not
     */
    public function deletePizza($id)
    {
        $this->pizzaInterface->deletePizzaById($id);
        return redirect()->route('admin.pizza.list')->with(['message' => 'The pizza is deleted successfully!']);
    }

    /**
     * To search pizza
     * @param Request $request
     * @param list of pizzas
     */
    public function searchPizza(Request $request)
    {
        $pizzas = $this->pizzaInterface->searchPizza($request);
        return view('Admin.Pizza.pizzaList')->with(['pizzas' => $pizzas]);
    }

    /**
     * To export all pizzas data
     * @param
     * @return pizzas.xlsx
     */
    public function export()
    {
        return Excel::download(new PizzasExport($this->pizzaInterface), 'pizzas.csv');
    }
}
