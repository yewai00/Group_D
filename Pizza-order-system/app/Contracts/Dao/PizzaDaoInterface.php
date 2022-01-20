<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;



/**
 * Interface for Data Accessing Object of Post
 */
interface PizzaDaoInterface
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
    public function savePizza(Request $request, $fileName);

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
     * @param Request $request, $id, $fileName
     * @return
     */
    public function editPizza(Request $request, $id, $fileName);

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

    /**
     * to export all pizzas data
     * @param
     * @return list of pizza with category name
     */
    public function export();
}
