<?php

namespace App\Services;


use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Contracts\Dao\PizzaDaoInterface;
use App\Contracts\Services\PizzaServicesInterface;

class PizzaServices implements PizzaServicesInterface
{
    private $pizzaDao;

    /**
     * Class Constructor
     * @param PizzaDaoInterface
     * @return
     */
    public function __construct(PizzaDaoInterface $pizzaDaoInterface)
    {
        $this->pizzaDao = $pizzaDaoInterface;
    }

    /**
     * To get all pizzas info
     * @param
     * @return Pizza Object array
     */
    public function getAllPizzasInfo()
    {
        $pizzas = $this->pizzaDao->getAllPizzasInfo();
        return $pizzas;
    }

    /**
     * To save new pizza
     * @param Request $request
     * @return
     */
    public function savePizza(Request $request)
    {
        $file = $request->file('image');

        $fileName = 'img_' . uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path() . '/img/', $fileName);
        $this->pizzaDao->savePizza($request, $fileName);
        return true;
    }

    /**
     * To get pizza info by id
     * @param $id
     * @return pizza object $pizza
     */
    public function getPizzaById($id)
    {
        $pizza = $this->pizzaDao->getPizzaById($id);
        return $pizza;
    }

     /**
     * To get all categories
     * @param
     * @return list of Categories
     */
    public function getAllCategories(){
        return $this->pizzaDao->getAllCategories();
    }

    /**
     * To edit pizza info
     * @param Request $request, $id
     * @return
     */
    public function editPizza(Request $request, $id)
    {
        $file = $request->file('image');
        $fileName="";
        if ($file != null) {
            $pizza = $this->pizzaDao->getPizzaById($id);
            if (File::exists(public_path() . '/img/' . $pizza->image)) {
                File::delete(public_path() . '/img/' . $pizza->image);
            }

            //new image
            $fileName = 'img_' . uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/img/', $fileName);
        }
        $this->pizzaDao->editPizza($request, $id,$fileName);
        return true;
    }

    /**
     * To delete pizza by id
     * @param $id
     * @return
     */
    public function deletePizzaById($id){
        $pizza = $this->pizzaDao->getPizzaById($id);
        if (File::exists(public_path() . '/img/' . $pizza->image)) {
            File::delete(public_path() . '/img/' . $pizza->image);
        }
        return $this->pizzaDao->deletePizzaById($id);
    }

    /**
     * To search pizza by keyword
     * @param Request $request
     * @return list of pizza
     */
    public function searchPizza(Request $request){
        return $this->pizzaDao->searchPizza($request);
    }

    /**
     * to export all pizzas data
     * @param
     * @return list of pizza with category name
     */
    public function export(){
        return $this->pizzaDao->export();
    }

}
