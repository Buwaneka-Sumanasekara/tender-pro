<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\TmTenderStatus;

class TenderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar_tender_status=[
            ["id"=>0,"name"=>"removed"],
            ["id"=>1,"name"=>"active"],
        ];

        foreach ($ar_tender_status as $tender_status) {
            TmTenderStatus::updateOrCreate([
                'id' => $tender_status['id']
            ],$tender_status);
        }
    }
}
