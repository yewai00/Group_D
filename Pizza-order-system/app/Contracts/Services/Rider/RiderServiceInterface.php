<?php

namespace App\Contracts\Services\Rider;
use Illuminate\Http\Request;


interface RiderServiceInterface
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
     * To export all riders info into csv
     * @param
     * @return
     */
    public function export();

     /**
     * to upload csv file into riders table
     * @param Request $request
     * @return message success or not
     */
    public function upload(Request $request);
}

