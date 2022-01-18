<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;



/**
 * Interface for Data Accessing Object of Post
 */
interface PizzaServicesInterface
{
    /**
     * To get all pizzas info
     * @param
     * @return Pizza Object array
     */
    public function getAllPizzasInfo();

    /**
     * To save new pizza
     * @param Request $request
     * @return
     */
    public function savePizza(Request $request);

    /**
     * To get pizza info by id
     * @param $id
     * @return pizza object $pizza
     */
    public function getPizzaById($id);

     /**
     * To get all categories
     * @param
     * @return list of Categories
     */
    public function getAllCategories();

    /**
     * To edit pizza info
     * @param Request $request, $id
     * @return
     */
    public function editPizza(Request $request,$id);

    /**
     * To delete pizza by id
     * @param $id
     * @return
     */
    public function deletePizzaById($id);

    /**
     * To search pizza by keyword
     * @param Request $request
     * @return list of pizza
     */
    public function searchPizza(Request $request);


}
