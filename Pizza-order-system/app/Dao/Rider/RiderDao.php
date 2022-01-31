<?php

namespace App\Dao\Rider;

use Illuminate\Http\Request;
use App\Contracts\Dao\Rider\RiderDaoInterface;
use App\Models\Rider;
use Illuminate\Support\Facades\DB;

class RiderDao implements RiderDaoInterface {

    /**
     * get rider list
     * @return object $rider
     */
    public function getRidersList(){
       $riders = Rider::paginate(8);
       return $riders;
    }

    /**
     * store rider
     * @param Request $request
     *
     */
    public function store(Request $request) {
       $riders = DB::transaction(function () use ($request) {
            Rider::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);
        }, 5);
        return $riders;
    }

    /**
     * update rider
     * @param Request $request
     * @param $id
     *
     */
    public function update(Request $request, $id) {
        DB::transaction(function () use ($request, $id){
            Rider::find($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);
        }, 5);
    }

    /**
     * edit rider
     * @param $id
     * @return object $rider
     */
    public function edit($id) {
        $rider = Rider::find($id);
        return $rider;
    }

    /**
     * delete rider
     * @param $id
     *
     */
    public function destroy($id) {
        DB::transaction(function () use ($id) {
            Rider::find($id)->delete();
        }, 5);
    }

    /**
     * search with name and email
     * @param Request $request
     * @return search result
     */
    public function search(Request $request) {
        $keyword = $request->riders;
        $riders = DB::table('riders')->where('name', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('riders.email', 'LIKE', '%' . $keyword . '%');
        return $riders->paginate(8);
    }

    /**
     * To export all rider data
     * @param
     * @return
     */
    public function export(){
        return Rider::select('id', 'name','email','phone','address','created_at','updated_at')->get();
    }
}
