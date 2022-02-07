<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PizzasExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PizzaFormRequest;
use App\Contracts\Services\PizzaServicesInterface;

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
        return view('admin.pizza.pizzaList')->with(['pizzas' => $pizzas]);
    }

    /**
     * To redirect pizza form to create new pizza
     * @param
     * @return view
     */
    public function showNewPizzaForm()
    {
        $categories = $this->pizzaInterface->getAllCategories();
        return view('admin.pizza.newPizza')->with(['categories' => $categories]);
    }

    /**
     * To create new pizza
     * @param Request $request
     * @return message success or not
     */
    public function submitNewPizzaForm(PizzaFormRequest $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $this->pizzaInterface->savePizza($request);
        return redirect()->route('pizza-list')->with(['message' => 'The new pizza is successfully added!']);
    }

    /**
     * To show details info of pizza
     * @param $id
     * @return view
     */
    public function pizzaDetails($id)
    {
        $pizza = $this->pizzaInterface->getPizzaById($id);
        return view('admin.pizza.pizzaDetail')->with(['pizza' => $pizza]);
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
        return view('admin.pizza.editPizza')->with(['pizza' => $pizza, 'categories' => $categories]);
    }

    /**
     * To edit pizz info
     * @param Request $request, $id
     * @return message success or not
     */
    public function submitEditPizzaForm(PizzaFormRequest $request, $id)
    {
        $this->pizzaInterface->editPizza($request, $id);
        return redirect()->route('pizza-list')->with(['message' => 'The pizza is successfully updated!']);
    }

    /**
     * To redirect to confirm delete pizzza
     * @param $id
     * @return
     */
    public function showDeletePizzaConfirm($id)
    {
        $pizza = $this->pizzaInterface->getPizzaById($id);
        return view('admin.pizza.deletePizza')->with(['pizza' => $pizza]);
    }

    /**
     * To delete pizza by id
     * @param $id
     * @return message success or not
     */
    public function deletePizza($id)
    {
        $this->pizzaInterface->deletePizzaById($id);
        return redirect()->route('pizza-list')->with(['message' => 'The pizza is deleted successfully!']);
    }

    /**
     * To search pizza
     * @param Request $request
     * @param list of pizzas
     */
    public function searchPizza(Request $request)
    {
        $pizzas = $this->pizzaInterface->searchPizza($request);
        return view('admin.pizza.pizzaList')->with(['pizzas' => $pizzas]);
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
