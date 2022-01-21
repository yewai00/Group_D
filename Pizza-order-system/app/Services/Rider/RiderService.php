<?php

namespace App\Services\Rider;

use Illuminate\Http\Request;
use App\Exports\RidersExport;
use App\Imports\RidersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Dao\Rider\RiderDaoInterface;
use App\Contracts\Services\Rider\RiderServiceInterface;

class RiderService implements RiderServiceInterface {

    /**
     * rider dao
     */
    private $riderDao;
    /**
     * Class Constructor
     * @param RiderDaoInterface $riderDao
     * @return void
     */
    public function __construct(RiderDaoInterface $riderDao)
    {
        $this->riderDao = $riderDao;
    }

    /**
     * get rider list
     * @return object riders
     */
    public function getRidersList(){
       return $this->riderDao->getRidersList();
    }

    /**
     * store rider
     * @param Request $request
     */
    public function store(Request $request) {
       return $this->riderDao->store($request);
    }

    /**
     * update rider
     * @param Request $request
     */
    public function update(Request $request, $id) {
        return $this->riderDao->update($request, $id);
    }

    /**
     * find edit id
     * @param $id
     */
    public function edit($id) {
       return $this->riderDao->edit($id);
    }

    /**
     * delete rider
     * @param $id
     */
    public function destroy($id) {
        return $this->riderDao->destroy($id);
    }

    /**
     * search name and email
     * @param Request $request
     *
     */
    public function search(Request $request) {
        return $this->riderDao->search($request);
    }

    /**
     * To export all riders info into csv
     * @param
     * @return
     */
    public function export(){
        return Excel::download(new RidersExport($this->riderDao), 'riders.csv');
    }

    /**
     * to upload csv file into riders table
     * @param Request $request
     * @return message success or not
     */
    public function upload(Request $request){
        return Excel::import(new RidersImport, $request->file('file'));
    }
}
