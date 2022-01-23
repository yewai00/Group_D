<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Contracts\Services\UserServicesInterface;
use SebastianBergmann\Environment\Console;

class UserController extends Controller
{

    private $userInterface;

    /**
     * Class constructor
     * @param UserServicesInterface
     * @return
     */
    public function __construct(UserServicesInterface $userServicesInterface)
    {
        $this->userInterface = $userServicesInterface;
    }


    /**
     * To redirect register form
     * @param
     * @return view
     */
    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    /**
     * to register user
     * @param Request $request
     * @return message success or not
     */
    public function submitRegisterForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:11',
            'address' => 'required|max:1000',
            'password' => 'required|min:8|same:confirmation',
            'confirmation' => 'required'
        ]);

        $this->userInterface->saveUser($request);
        return redirect()->route('login.get');
    }

    /**
     * To redirect register form
     * @param
     * @return view
     */
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    /**
     * to Login user
     * @param Request $request
     * @return message success or not
     */
    public function submitLoginForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->userInterface->login($request);
        $status = $this->userInterface->login($request);
        if ($status) {
            return redirect()->route('admin.pizza.list');
        }

        return back()->with(['error' => 'Oppes! You have entered invalid credentials']);
    }

    /**
     * to logout user
     * @param
     * @return
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login.get');
    }

    /**
     * to redirect admin profile
     * @param
     * @return
     */
    public function showAdminProfile()
    {
        return view('Admin.Profile.profile');
    }

    /**
     * to update admin profile
     * @param Request $request ,$id
     * @return view
     */
    public function submitAdminProfile(Request $request, $id)
    {
        $this->userInterface->updateUserInfo($request, $id);
        return back()->with(['message' => 'Your profile is successfully updated!']);
    }

    /**
     * To redirect admin change password page
     * @param
     * @return
     */
    public function showAdminChangePasswordForm()
    {
        return view('Admin.Profile.changePassword');
    }

    /**
     * to change user password
     * @param Request $request
     * @return message success or not
     */
    public function submitChangePasswordForm(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $status = $this->userInterface->updateUserPassword($request);
        if ($status) {
            return redirect()->route('admin.profile')->with(['message' => "The password is successfully updated!"]);
        }
        return back()->with(['error' => 'The old password is invalid!']);
    }

    /**
     * to get all customers list
     * @param $role
     * @return customers list
     */
    public function getAllUsersList($role_id)
    {
        $role=$role_id==1?'admin':'user';
        $users = $this->userInterface->getAllUsers($role);
        if ($role == 'user') {
            return view('Admin.Users.userList')->with(['users' => $users]);
        }
        if ($role == 'admin') {
            return view('Admin.Users.adminList')->with(['users' => $users]);
        }
    }

    /**
     * to search user
     * @param $request, $role
     * @return lists of arrays
     */
    public function search(Request $request, $role_id)
    {
        $role=$role_id==1?'admin':'user';
        dd($role);
        $users = $this->userInterface->search($request, $role);
        if ($role == 'user') {
            return view('Admin.Users.userList')->with(['users' => $users]);
        }
        if ($role == 'admin') {
            return view('Admin.Users.adminList')->with(['users' => $users]);
        }
    }

    /**
     * to export user list
     * @param $role
     * @return list of user
     */
    public function export($role)
    {
        return $this->userInterface->export($role);
    }
}
