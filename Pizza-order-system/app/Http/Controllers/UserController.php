<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Contracts\Services\UserServicesInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



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
        if($status){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.profile');
            }
            elseif(Auth::user()->role == 'user'){
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

          Mail::send('Auth.forgetPasswordMail', ['token' => $token], function($message) use($request){
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
    public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|same:confirmation',
              'confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

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
    public function submitAdminProfile(Request $request, $id)
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
     * to change user password
     * @param Request $request
     * @return message success or not
     */
    public function submitUserChangePasswordForm(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
        ]);

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
        return $this->userInterface->export($role);
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
    public function newAdminForm(){
        return view('Admin.Profile.newAdmin');
    }

    /**
     * To create new admin
     * @param
     * @return view
     */
    public function submitNewAdminForm(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:11',
            'address' => 'required|max:1000',
            'password' => 'required|min:8|same:confirmation',
            'confirmation' => 'required'
        ]);

        $this->userInterface->saveUser($request);
        return back()->with(['message'=>'The new admin is added successfullly!']);
    }
}
