<?php

namespace App\Services;

use App\Contracts\Services\CustServiceInterface;
use App\Contracts\Dao\CustDaoInterface;

class CustService implements CustServiceInterface {

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
    public function getCategoriesList() {
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
}
?>