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

    public function submitForgetPasswordForm(Request $request);

    /**
     * To get current reset password data of user
     * 
     * @param string $email
     * @param string $token
     * @return Object created reset_password object
     */
    public function getResetPassword($email, $token);

    /**
     * To change password of user 
     * 
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function resetPassword($email, $password);

    /**
     * To delte row of password reset table 
     * 
     * @param string $email
     * @return bool
     */
    public function deletePasswordTableData($email);

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
