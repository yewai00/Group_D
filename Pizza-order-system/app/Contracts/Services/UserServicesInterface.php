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
     * To store forget password data and send email
     * 
     * @param Request $request request including inputs
     * @return
     */
    public function processForgetPasswordForm(Request $request);

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
     * To deelte row of password reset table 
     * 
     * @param string $email
     * @return bool
     */
    public function deletePasswordTableData($email);
}
