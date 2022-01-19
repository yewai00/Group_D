<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;



/**
 * Interface for Data Accessing Object of Post
 */
interface UserServicesInterface
{
    /**
     * To create new user
     * @param Request $request
     * @return true
     */
    public function saveUser(Request $request);

    /**
     * to Login user
     * @param Request $request
     * @return message success or not
     */
    public function login(Request $request);
}
