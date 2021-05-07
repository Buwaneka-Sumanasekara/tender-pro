<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OmOfferStatus;

class OfferStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar_offer_status=[
            ["id"=>0,"name"=>"Pending"],
            ["id"=>1,"name"=>"Approved"],
            ["id"=>2,"name"=>"Rejected"],
        ];

        foreach ($ar_offer_status as $offer_status) {
            OmOfferStatus::updateOrCreate([
                'id' => $offer_status['id']
            ],$offer_status);
        }
    }
}
