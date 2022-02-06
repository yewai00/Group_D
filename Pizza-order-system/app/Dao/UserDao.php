<?php

namespace App\Dao;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () use ($request) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            if ($request->role != '') {
                $user->role = $request->role;
            }
            $user->save();
        });
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
        DB::transaction(function () use ($request, $user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save();
        });
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
        DB::transaction(function () use ($request, $user) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        });
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
        return DB::table('password_resets')
            ->where([
                'email' => $email,
                'token' => $token
            ])
            ->first();
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
        return User::where('email', $email)
            ->update(['password' => Hash::make($password)]);
    }

    /**
     * To delte row of password reset table
     *
     * @param string $email
     * @return bool
     */
    public function deletePasswordTableData($email)
    {
        DB::transaction(function () use ($email) {
            DB::table('password_resets')->where(['email' => $email])->delete();
        });
        return true;
    }

    /**
     * to get all customers list
     * @param
     * @return customers list
     */
    public function getAllUsers($role)
    {
        return User::select('id', 'name', 'email', 'phone', 'address', 'role', 'created_at', 'updated_at')
            ->where('role', $role)->paginate(8);
    }

    /**
     * to get all customers list
     * @param
     * @return customers list
     */
    public function export($role)
    {

        $users = User::select('id', 'name', 'email', 'phone', 'address', 'role', 'created_at', 'updated_at')
            ->where('role', $role)->get();
        return $users;
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
