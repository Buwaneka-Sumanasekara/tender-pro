<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\PmPermissions;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar_permissions=[
            //admin permissions
            ["id"=>1000,"permission"=>"Create/Edit Tender Categories","tab_name"=>"Tender Categories",'order_no'=>1],
            ["id"=>1001,"permission"=>"Create Tender","tab_name"=>"Create Tender",'order_no'=>2],
            ["id"=>1002,"permission"=>"List Unpublished/Draft Tenders","tab_name"=>"Draft Tenders",'order_no'=>3],
            ["id"=>1003,"permission"=>"View Tender Bids","tab_name"=>"Tender Bids",'order_no'=>4],
            ["id"=>1004,"permission"=>"Active/Block users","tab_name"=>"User Management",'order_no'=>5],

            ["id"=>1100,"permission"=>"Profile details of user","tab_name"=>"My Profile",'order_no'=>10],
            ["id"=>1101,"permission"=>"Change Password","tab_name"=>"Change Password",'order_no'=>11],

            //vendor permissions
            ["id"=>2000,"permission"=>"View all bids of user","tab_name"=>"View My Bids",'order_no'=>2000],
            ["id"=>2001,"permission"=>"View all approved of user","tab_name"=>"Approved Bids",'order_no'=>2001],
            
            ["id"=>2100,"permission"=>"Update Profile details of user","tab_name"=>"My Profile",'order_no'=>2002],
            ["id"=>2101,"permission"=>"Change Password","tab_name"=>"Change Password",'order_no'=>2003],
        ];

        foreach ($ar_permissions as $permission) {
            PmPermissions::updateOrCreate([
                'id' => $permission['id']
            ],$permission);
        }
    }
}
