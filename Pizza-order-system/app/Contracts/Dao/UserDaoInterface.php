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

    /**
     * to update user info
     * @param Request $request, $id
     * @return true
     */
    public function updateUserInfo(Request $request, $id);

    /**
     * To update user password
     * @param Request $request,id
     * @return message success or not
     */
    public function updateUserPassword(Request $request);

    /**
     * to get all customers list
     * @param
     * @return customers list
     */
    public function getAllUsers($role);

    /**
     * to search user
     * @param $request, $role
     * @return lists of arrays
     */
    public function search(Request $request, $role);
}
