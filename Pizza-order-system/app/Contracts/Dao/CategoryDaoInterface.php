<?php 

namespace App\Contracts\Dao;
use Illuminate\Http\Request;


interface CategoryDaoInterface 
{
    /**
     * get category list
     */
    public function getCategoriesList();

    /**
     * store category
     * @param Request $request
     */
    public function store(Request $request);

    /**
     * update category
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id);

    /**
     * edit category
     * @param $id
     */
    public function edit($id);

    /**
     * delete category
     * @param $id
     */
    public function destroy($id);

    /**
     * search category
     * @param Request $request
     */
    public function search(Request $request);
}
?>