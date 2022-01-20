<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Dao\CategoryDaoInterface;
use App\Contracts\Services\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface {

    /**
     * category dao
     */
    private $categoryDao;
    /**
     * Class Constructor
     * @param CategoryDaoInterface $categoryDao
     * @return void
     */
    public function __construct( CategoryDaoInterface $categoryDao )
    {
        $this->categoryDao = $categoryDao;
    }

    /**
     * get category list
     * @return object categories
     */
    public function getCategoriesList(){
       return $this->categoryDao->getCategoriesList();
    }

    /**
     * store category
     * @param Request $request
     */
    public function store(Request $request) {
       return $this->categoryDao->store($request);
    }

    /**
     * update category
     * @param Request $request
     */
    public function update(Request $request, $id) {
        return $this->categoryDao->update($request, $id);
    }

    /**
     * find edit id
     * @param $id
     */
    public function edit($id) {
       return $this->categoryDao->edit($id);
    }

    /**
     * delete category
     * @param $id
     */
    public function destroy($id) {
        return $this->categoryDao->destroy($id);
    }

    /**
     * search name and email
     * @param Request $request
     *
     */
    public function search(Request $request) {
        return $this->categoryDao->search($request);
    }

    /**
     * To export all categories information
     * @param
     * @return list of categories
     */
    public function export(){

        return Excel::download(new CategoriesExport($this->categoryDao), 'categories.csv');
    }


    /**
     * to upload csv file into categories table
     * @param Request $request
     * @return message success or not
     */
    public function upload(Request $request){
        return Excel::import(new CategoriesImport, $request->file('file'));

    }
}
