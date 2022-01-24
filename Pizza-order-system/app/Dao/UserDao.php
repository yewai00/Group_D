<?php

namespace App\Dao;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\UserDaoInterface;

class UserDao  implements UserDaoInterface
{
    /**
     * To create new user
     * @param Request $request
     * @return true
     */
    public function saveUser(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->save();
        return true;
    }

    /**
     * to update user info
     * @param Request $request, $id
     * @return true
     */
    public function updateUserInfo(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return true;
    }

    /**
     * To update user password
     * @param Request $request,id
     * @return message success or not
     */
    public function updateUserPassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return true;
    }

    public function submitForgetPasswordForm(Request $request)
    {

    }

    /**
     * To get current reset password data of user
     * 
     * @param string $email
     * @param string $token
     * @return Object created reset_password object
     */
    public function getResetPassword($email, $token)
    {

    }

    /**
     * To change password of user 
     * 
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function resetPassword($email, $password)
    {

    }

    /**
     * To delte row of password reset table 
     * 
     * @param string $email
     * @return bool
     */
    public function deletePasswordTableData($email)
    {
        
    }
    /**
     * to get all customers list
     * @param
     * @return customers list
     */
    public function getAllUsers($role)
    {
        return User::select('id', 'name', 'email', 'phone', 'address', 'created_at', 'updated_at')
            ->where('role', $role)->paginate(8);
    }

    /**
     * to search user
     * @param $request, $role
     * @return lists of arrays
     */
    public function search(Request $request, $role)
    {
        $key = $request->search;
        return User::where('role', $role)
            ->where(function ($query) use ($key) {
                $query->orwhere('name', 'like', '%' . $key . '%')
                    ->orwhere('email', 'like', '%' . $key . '%')
                    ->orwhere('address', 'like', '%' . $key . '%');
            })
            ->paginate(8);
    }
}
