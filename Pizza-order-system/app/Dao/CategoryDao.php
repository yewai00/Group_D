<?php

namespace App\Dao;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\CategoryDaoInterface;

class CategoryDao implements CategoryDaoInterface
{

    /**
     * get category list
     * @return object $category
     */
    public function getCategoriesList(){
        $categories = Category::leftjoin('pizzas','categories.id','pizzas.category_id')
        ->select('categories.*',DB::raw('count(pizzas.id) as count'))
        ->groupBy('categories.id')
        ->paginate(8);
       return $categories;
    }

    /**
     * store category
     * @param Request $request
     *
     */
    public function store(Request $request) {
       $categories = DB::transaction(function () use ($request) {
            Category::create([
                'name' => $request->name,
            ]);
        }, 5);
        return $categories;
    }

    /**
     * update category
     * @param Request $request
     * @param $id
     *
     */
    public function update(Request $request, $id) {
        DB::transaction(function () use ($request, $id){
            Category::find($id)->update([
                'name' => $request->name,
            ]);
        }, 5);
    }

    /**
     * edit category
     * @param $id
     * @return object $category
     */
    public function edit($id) {
        $category = Category::find($id);
        return $category;
    }

    /**
     * delete category
     * @param $id
     *
     */
    public function destroy($id) {
        DB::transaction(function () use ($id) {
            Category::find($id)->delete();
        }, 5);
    }

    /**
     * search with name and email
     * @param Request $request
     * @return search result
     */
    public function search(Request $request) {
        $keyword = $request->search;
        $categories = DB::table('categories')->where('name', 'LIKE', '%' . $keyword . '%');
        return $categories->paginate(8);
    }

    /**
     * To export all categories information
     * @param
     * @return list of categories
     */
    public function export(){
        return Category::all();
    }
}
