<?php 

namespace App\Contracts\Dao;

interface CustDaoInterface {
    
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
}
?>