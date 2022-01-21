<?php

namespace App\Services;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServicesInterface;

class UserServices implements UserServicesInterface
{
    private $userDao;

    /**
     * Class Constructor
     * @param UserDaoInterface
     * @return
     */
    public function __construct(UserDaoInterface $userDaoInterface)
    {
        $this->userDao = $userDaoInterface;
    }

    /**
     * To create new user
     * @param Request $request
     * @return true
     */
    public function saveUser(Request $request)
    {
        $this->userDao->saveUser($request);
        Mail::send('Auth.registerMail', ['name' => $request->name], function ($message) use ($request) {
            $message->to($request->email, 'New User')->subject('Registration Information');
        });
        return true;
    }

    /**
     * to Login user
     * @param Request $request
     * @return message success or not
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * to update user info
     * @param Request $request, $id
     * @return true
     */
    public function updateUserInfo(Request $request, $id)
    {
        return $this->userDao->updateUserInfo($request, $id);
    }

    /**
     * To update user password
     * @param Request $request,id
     * @return message success or not
     */
    public function updateUserPassword(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $this->userDao->updateUserPassword($request);
            return true;
        }
        return false;
    }

    /**
     * to get all customers list
     * @param
     * @return customers list
     */
    public function getAllUsers($role)
    {
        return $this->userDao->getAllUsers($role);
    }

    /**
     * to search user
     * @param $request, $role
     * @return lists of arrays
     */
    public function search(Request $request, $role)
    {
        return $this->userDao->search($request, $role);
    }

    /**
     * to export user list
     * @param $role
     * @return list of user
     */
    public function export($role)
    {
        if ($role == 'user') {
            return Excel::download(new UsersExport($this->userDao, $role), 'userList.csv');
        } elseif ($role == 'admin') {
            return Excel::download(new UsersExport($this->userDao, $role), 'adminList.csv');
        }
    }
}
