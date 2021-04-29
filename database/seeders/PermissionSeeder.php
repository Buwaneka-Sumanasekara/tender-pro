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
            ["id"=>1000,"permission"=>"Create/Edit Tender Categories","tab_name"=>"Tender Categories"],
            ["id"=>1001,"permission"=>"Create Tender","tab_name"=>"Create Tender"],
            ["id"=>1002,"permission"=>"List Unpublished/Draft Tenders","tab_name"=>"Draft Tenders"],
            ["id"=>1003,"permission"=>"View Tender Bids","tab_name"=>"Tender Bids"],
            ["id"=>1004,"permission"=>"Active/Block users","tab_name"=>"User Management"],

            ["id"=>1100,"permission"=>"Profile details of user","tab_name"=>"My Profile"],
            ["id"=>1101,"permission"=>"Change Password","tab_name"=>"Change Password"],

            //vendor permissions
            ["id"=>2000,"permission"=>"View all bids of user","tab_name"=>"View My Bids"],
            ["id"=>2001,"permission"=>"View all approved of user","tab_name"=>"Approved Bids"],
            
            ["id"=>2100,"permission"=>"Update Profile details of user","tab_name"=>"My Profile"],
            ["id"=>2101,"permission"=>"Change Password","tab_name"=>"Change Password"],
        ];

        foreach ($ar_permissions as $permission) {
            PmPermissions::updateOrCreate([
                'id' => $permission['id']
            ],$permission);
        }
    }
}
