<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;


interface CategoryServiceInterface
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

    /**
     * To export all categories information
     * @param
     * @return list of categories
     */
    public function export();

    /**
     * to upload csv file into categories table
     * @param Request $request
     * @return message success or not
     */
    public function upload(Request $request);
}
