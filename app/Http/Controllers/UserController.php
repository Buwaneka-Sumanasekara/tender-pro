<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Http\Traits\UserTrait;
use App\Models\UmUser;
use App\Models\UmUserLogin;
use App\Models\VmVendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use UserTrait;

    /*
     * Login function
     */
    public function user_login(Request $request)
    {
        try {
            
           $validator=Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
           ],[
            'username.required' => ':attribute field is required.',
            'password.required' => ':attribute field is required.'
           ]);
           if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
           }


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


    /*
     * Registration function
     */
    public function user_registration(Request $request)
    {
        try {
            

            $validator=Validator::make($request->all(), [
                'firstname' => 'required',
                'company_email' => 'required|email',
                'username' => 'required|email|unique:um_user_login,username',
                'password' => 'required|confirmed',
               ],[
                'firstname.required' => ':attribute field is required.',
                'username.required' => ':attribute field is required.',
                'password.required' => ':attribute field is required.',
                'company_email.required' => ':attribute field is required.',
                'username.email' => ':attribute field is not valid email address.',
                'username.unique' => ':attribute is already registered',
                'company_email.email' => ':attribute field is not valid email address.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

              
            DB::beginTransaction();
                $user_id=(UmUser::max('id')+1);

                $user = UmUser::create([
                    'id'=>$user_id,
                    'firstname' => $request->get('firstname'),
                    'lastname' => $request->get('lastname'),
                    'um_user_status_id'=>config("global.user_status_active"),
                    'um_user_role_id'=>config("global.user_role_vendor"),
                ]);
                
                $user_login = UmUserLogin::create([
                    'id'=>$user_id,
                    'username' => $request->get('username'),
                    'password' => Hash::make($request->get('password')),
                    'um_user_id'=>$user_id
                ]);
                
                $vendor = VmVendor::create([
                    'id'=>$user_id,
                    'company_name' => $request->get('company_name'),
                    'address' => $request->get('company_address'),
                    'contact_email' => $request->get('company_email'),
                    'contact_mobile' => $request->get('company_contact_mobile'),
                    'contact_office' => $request->get('company_contact_office'),
                    'um_user_id'=>$user_id
                ]);
            DB::commit();
                
            return redirect("/login");
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back()->withInput();
        }
    }
}
