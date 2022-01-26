<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface CustDaoInterface
{

    /**
     * show pizza list
     */
    public function getPizzasList();

    /**
     * show categories list
     */
    public function getCategoriesList();

    /**
     * show pizza detail
     * @param $id
     */
    public function getPizzaDetail($id);

    /**
     * to get pizza list by category
     * @param Request $request
     * @return pizza list
     */
    public function searchPizza(Request $request);

}
