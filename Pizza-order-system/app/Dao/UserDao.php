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
}
