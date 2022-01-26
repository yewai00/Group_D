<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Contracts\Dao\CustDaoInterface;
use App\Contracts\Services\CustServiceInterface;

class CustService implements CustServiceInterface
{

    private $pizzaDao;

    /**
     * Class Constructor
     * @param CustDaoInterface
     * @return
     */
    public function __construct(CustDaoInterface $custDaoInterface)
    {
        $this->custDao = $custDaoInterface;
    }

    /**
     * get pizza list
     */
    public function getPizzasList()
    {
        return $this->custDao->getPizzasList();
    }

    /**
     * get categories list
     */
    public function getCategoriesList()
    {
        return $this->custDao->getCategoriesList();
    }

    /**
     * get pizza detail
     * @param $id
     */
    public function getPizzaDetail($id)
    {
        return $this->custDao->getPizzaDetail($id);
    }

    /**
     * to get pizza list by category
     * @param Request $request
     * @return pizza list
     */
    public function searchPizza(Request $request)
    {
        return $this->custDao->searchPizza($request);
    }
}
