<?php
namespace App\Http\Traits;
use App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{

    
    public function user_role_getUserRolePermissions($user_role)
    {
        $permissions = DB::select("select per.* from pm_permissionss per inner join um_user_role_has_permissions ur_per on per.id=ur_per.pm_permissions_id
        where ur_per.um_user_role_id='" . $user_role . "'  order by `order_no` asc ");
        return $permissions;
    }

}