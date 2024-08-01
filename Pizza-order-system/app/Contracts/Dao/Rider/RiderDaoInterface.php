<?php

namespace App\Contracts\Dao\Rider;

use Illuminate\Http\Request;


interface RiderDaoInterface
{
    /**
     * get rider list
     */
    public function getRidersList();

    /**
     * store rider
     * @param Request $request
     */
    public function store(Request $request);

    /**
     * update rider
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id);

    /**
     * edit rider
     * @param $id
     */
    public function edit($id);

    /**
     * delete rider
     * @param $id
     */
    public function destroy($id);

    /**
     * search rider
     * @param Request $request
     */
    public function search(Request $request);

    /**
     * To export all rider data
     * @param
     * @return
     */
    public function export();
}
