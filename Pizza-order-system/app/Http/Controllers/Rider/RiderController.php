<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Services\Rider\RiderServiceInterface;
use Dotenv\Store\File\Reader;
use App\Http\Requests\StoreRiderRequest;
use App\Http\Requests\UpdateRiderRequest;

class RiderController extends Controller
{
    /**
     * rider interface
     */
    private $riderInterface;

    /**
     * Class Contructor
     * @param RiderServiceInterface $riderServiceInterface
     * @return void
     */
    public function __construct(RiderServiceInterface $riderServiceInterface)
    {
        $this->riderInterface = $riderServiceInterface;
    }

    /**
     * show riders list 
     * 
     * @return view to index with $riders list
     */
    public function index(){
        $riders = $this->riderInterface->getRidersList();
        return view('Admin.riders.index')
            ->with('riders',$riders);
    }

    /**
     * create rider 
     * 
     * @return redirect to index with message
     */
    public function store(StoreRiderRequest $request) {
        $this->riderInterface->store($request);
        return redirect()->route('riders.index')
                ->with('success', 'rider created successfully.');
    }

    /**
     * show create page
     * 
     */
    public function create() {
        return view('Admin.riders.create');
    }

    /**
     * update rider 
     * @param UpdateRiderRequest $request
     * @param $id
     * @returb redirect to index with message
     */
    public function update(UpdateRiderRequest $request, $id) {
        $this->riderInterface->update($request, $id); 
        return redirect()->route('riders.index')
                ->with('success', 'rider updated successfully.'); 
    }

    /**
     * show edit page
     * 
     * @param $id
     * @return view to edit page
     */
    public function edit($id) {
        $rider = $this->riderInterface->edit($id);
        return view('Admin.riders.edit')
            ->with('rider', $rider);
    }

    /**
     * delete rider
     * 
     * @param $id
     * @return redirect to index page with message
     */
    public function destroy($id) {
        $delete = $this->riderInterface->destroy($id);
        return redirect()->route('riders.index')
                ->with('success', 'rider deleted successfully.');
    }

    /**
     * search name and email
     * @param Request $request
     * return view to index page with search result
     * 
     */
    public function search(Request $request) {
        $riders = $this->riderInterface->search($request);
        return view('Admin.riders.index')
                    ->with('riders', $riders);
    }
}