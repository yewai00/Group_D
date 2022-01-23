<?php 

namespace App\Dao;

use App\Contracts\Dao\CustDaoInterface;
use App\Models\Category;
use App\Models\Pizza;

class CustDao implements CustDaoInterface {

    /**
     * get pizza list
     * @return pizza list
     */
    public function getPizzasList() {
        return Pizza::paginate(6);
    }

    /**
     * get categories list
     * @return category list
     */
    public function getCategoriesList() {
        return Category::all();
    }

    /**
     * get pizza detail
     * @return pizza detail
     */
    public function getPizzaDetail($id)
    {
        return Pizza::find($id);
    }
}
?>