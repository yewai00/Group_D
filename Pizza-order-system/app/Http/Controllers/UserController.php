<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Contracts\Services\UserServicesInterface;



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
    public function submitRegisterForm(UserFormRequest $request)
    {
        $request->validate([
            'email' => 'unique:users,email',
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
    public function submitLoginForm(LoginFormRequest $request)
    {
        $this->userInterface->login($request);
        $status = $this->userInterface->login($request);
        if ($status) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.profile');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->route('cust');
            }
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
        return redirect()->route('cust');
    }

    /**
     * To show forgoet password email form page
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    /**
     * To Store password reset data in database and sned user email.
     *
     * @param \Illuminate\Http\Request $request
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('Auth.forgetPasswordMail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    /**
     * To show reset password form page
     *
     * @return response()
     */
    public function showResetPasswordForm($token)
    {
        return view('Auth.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * To reset the password with user input data
     *
     * @param App\Http\Requests\PasswordResetRequest $request
     * @return response()
     */

    public function submitResetPasswordForm(PasswordResetRequest $request)
    {
        $updatePassword = $this->userInterface->getResetPassword($request->email, $request->token);

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $this->userInterface->resetPassword($request->email, $request->password);

        $this->userInterface->deletePasswordTableData($request->email);

        return redirect('/login')->with('message', 'Your password has been changed!');
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
     * to redirect user profile
     * @param
     * @return
     */
    public function showUserProfile()
    {
        return view('customer.userDetail');
    }

    /**
     * to update admin profile
     * @param Request $request ,$id
     * @return view
     */
    public function submitAdminProfile(UpdateUserRequest $request, $id)
    {
        $this->userInterface->updateUserInfo($request, $id);
        return back()->with(['message' => 'Your profile is successfully updated!']);
    }

    /**
     * to update user profile
     * @param Request $request ,$id
     * @return view
     */
    public function submitUserProfile(Request $request, $id)
    {
        $this->userInterface->updateUserInfo($request, $id);
        return back()->with(['message' => 'Your profile is successfully updated!']);
    }

    /**
     * To redirect user change password page
     * @param
     * @return
     */
    public function showChangePasswordForm()
    {
        return view('Admin.Profile.changePassword');
    }


    /**
     * To redirect user change password page
     * @param
     * @return
     */
    public function showUserChangePasswordForm()
    {
        return view('customer.changePassword');
    }

    /**
     * to change user password
     * @param Request $request
     * @return message success or not
     */
    public function submitChangePasswordForm(ChangePasswordRequest $request, $id)
    {
        $status = $this->userInterface->updateUserPassword($request);
        if ($status) {
            return redirect()->route('admin.profile')->with(['message' => "The password is successfully updated!"]);
        }
        return back()->with(['error' => 'The old password is invalid!']);
    }

    /**
     * to change user password
     * @param Request $request
     * @return message success or not
     */
    public function submitUserChangePasswordForm(ChangePasswordRequest $request, $id)
    {
        $status = $this->userInterface->updateUserPassword($request);

        if ($status) {
            return redirect()->route('user.profile')->with(['message' => "The password is successfully updated!"]);
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
        $role = $role_id == 1 ? 'admin' : 'user';
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
        $role = $role_id == 1 ? 'admin' : 'user';
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
        if ($role == 'user') {
            return Excel::download(new UsersExport($this->userInterface, $role), 'userList.csv');
        } elseif ($role == "admin") {
            return Excel::download(new UsersExport($this->userInterface, $role), 'adminList.csv');
        }
    }

    public function test()
    {
        return view('customer.userDetail');
    }

    /**
     * To create new admin
     * @param
     * @return view
     */
    public function newAdminForm()
    {
        return view('Admin.Profile.newAdmin');
    }

    /**
     * To create new admin
     * @param
     * @return view
     */
    public function submitNewAdminForm(UserFormRequest $request)
    {
        $this->userInterface->saveUser($request);
        return back()->with(['message' => 'The new admin is added successfullly!']);
    }
}
