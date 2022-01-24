<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\CategoryServiceInterface;

class CategoryController extends Controller
{
    /**
     * category interface
     */
    private $categoryInterface;

    /**
     * Class Contructor
     * @param CategoryServiceInterface $categoryServiceInterface
     * @return void
     */
    public function __construct(CategoryServiceInterface $categoryServiceInterface)
    {
        $this->categoryInterface = $categoryServiceInterface;
    }

    /**
     * show categories list
     *
     * @return view to index with $categories list
     */
    public function index()
    {
        $categories = $this->categoryInterface->getCategoriesList();
        return view('Admin.category.index')
            ->with('categories', $categories);
    }

    /**
     * create category
     *
     * @return redirect to index with message
     */
    public function store(Request $request)
    {
        $this->categoryInterface->store($request);
        return redirect()->route('category.index')
            ->with('success', 'category created successfully.');
    }

    /**
     * show create page
     *
     */
    public function create()
    {
        return view('Admin.category.create');
    }

    /**
     * update category
     * @param Request $request
     * @param $id
     * @returb redirect to index with message
     */
    public function update(Request $request, $id)
    {
        $this->categoryInterface->update($request, $id);
        return redirect()->route('category.index')
            ->with('success', 'category updated successfully.');
    }

    /**
     * show edit page
     *
     * @param $id
     * @return view to edit page
     */
    public function edit($id)
    {
        $category = $this->categoryInterface->edit($id);
        return view('Admin.category.edit')
            ->with('category', $category);
    }

    /**
     * delete category
     *
     * @param $id
     * @return redirect to index page with message
     */
    public function destroy($id)
    {
        $delete = $this->categoryInterface->destroy($id);
        return redirect()->route('category.index')
            ->with('success', 'category deleted successfully.');
    }

    /**
     * search name and email
     * @param Request $request
     * return view to index page with search result
     *
     */
    public function search(Request $request)
    {
        $categories = $this->categoryInterface->search($request);
        return view('Admin.category.index')
            ->with('categories', $categories);
    }

    /**
     * to export all categories data
     * @param
     * @return list of categories as a csv file
     */
    public function export()
    {
        return $this->categoryInterface->export();
    }

    /**
     * To redirect category upload form
     * @param
     * @return view
     */
    public function showUploadForm()
    {
        return view('Admin.Category.upload');
    }

    /**
     * To upload csv file into categories table
     * @param csv file
     * @return message success or not
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv'
        ]);
        $this->categoryInterface->upload($request);
        return redirect()->route('category.index')->with(['message' => 'The choose file is successfully uploaded!']);
    }
}
