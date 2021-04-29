<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Http\Traits\UserTrait;
use App\Models\UmUser;
use App\Models\UmUserLogin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use UserTrait;

    /*
     * Login function
     */
    public function user_login(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'bail|required',
                'password' => 'required',
            ]);

            $username = $request->get('username');
            $password = $request->get('password');

            $user_login_object = UmUserLogin::where("username", $username)->first();
            if (!$user_login_object) {
                throw new Exception("Invalid User");
            } else {
                if (Hash::check($request->get('password'), $user_login_object->password)) {
                    $user_obj = UmUser::find($user_login_object->um_user_id);
                    if ($user_obj) {
                        if ($user_obj->um_user_status_id === config('global.user_status_active')) {
                            $user_permissions = $this->user_role_getUserRolePermissions($user_obj->um_user_role_id);
                            session(['logged_user_object' => $user_obj, 'permissions' => json_encode($user_permissions)]);
                            return redirect('/');
                        } else {
                            throw new Exception("Your account has been blocked, Please contact System Admin");
                        }
                    } else {
                        throw new Exception("User not found");
                    }
                } else {
                    throw new Exception("Login Faild");
                }
            }
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }

    public function user_logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

}
