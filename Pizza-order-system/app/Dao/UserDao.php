<?php

namespace App\Dao;

use App\Models\User;
use Illuminate\Http\Request;
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
}
