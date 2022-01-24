<?php

namespace App\Dao;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Contracts\Dao\PizzaDaoInterface;
use App\Models\Category;

class PizzaDao  implements PizzaDaoInterface
{

    /**
     * To get all pizzas info
     * @param
     * @return Pizza Object array
     */
    public function getAllPizzasInfo()
    {
        return Pizza::paginate(5);
    }

    /**
     * To save new pizza
     * @param Request $request
     * @return
     */
    public function savePizza(Request $request, $fileName)
    {
        $pizza = new Pizza;
        $pizza->name = $request->name;
        $pizza->image = $fileName;
        $pizza->category_id = $request->category_id;
        $pizza->price = $request->price;
        $pizza->buy_one_get_one = $request->buy_one_get_one;
        $pizza->description = $request->description;
        $pizza->save();
        return true;
    }

    /**
     * To get pizza info by id
     * @param $id
     * @return pizza object $pizza
     */
    public function getPizzaById($id)
    {
        return Pizza::find($id);
    }

    /**
     * To get all categories
     * @param
     * @return list of Categories
     */
    public function getAllCategories()
    {
        return Category::all();
    }

    /**
     * To edit pizza info
     * @param Request $request, $id, $fileName
     * @return
     */
    public function editPizza(Request $request, $id, $fileName)
    {
        $pizza = Pizza::find($id);
        $pizza->name = $request->name;
        $pizza->category_id = $request->category_id;
        $pizza->buy_one_get_one = $request->buy_one_get_one;
        $pizza->description = $request->description;
        if ($fileName != null) {
            $pizza->image = $fileName;
        }
        $pizza->save();
        return true;
    }

    /**
     * To delete pizza by id
     * @param $id
     * @return
     */
    public function deletePizzaById($id)
    {
        return Pizza::find($id)->delete();
    }

    /**
     * To search pizza by keyword
     * @param Request $request
     * @return list of pizza
     */
    public function searchPizza(Request $request)
    {
        $pizzas = Pizza::orwhere('name', 'like', '%' . $request->search . '%')
            ->orwhere('description', 'like', '%' . $request->search . '%')
            ->get();
        return $pizzas;
    }

    /**
     * to export all pizzas data
     * @param
     * @return list of pizza with category name
     */
    public function export()
    {
        $pizzas = Pizza::join('categories', 'pizzas.category_id', 'categories.id')
            ->select(
                'pizzas.id',
                'pizzas.name',
                'pizzas.image',
                'categories.name as category',
                'pizzas.buy_one_get_one',
                'pizzas.price',
                'pizzas.description',
                'pizzas.created_at',
                'pizzas.updated_at'
            )->get();
        return $pizzas;
    }
}
