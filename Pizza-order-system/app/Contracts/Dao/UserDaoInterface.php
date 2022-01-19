<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;



/**
 * Interface for Data Accessing Object of Post
 */
interface UserDaoInterface
{
    /**
     * To create new user
     * @param Request $request
     * @return true
     */
    public function saveUser(Request $request);
}
