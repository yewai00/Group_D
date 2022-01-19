<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
}
