<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Http\Traits\CommonTrait;

use App\Models\TmTender;
use Carbon\Carbon;

class TenderSeeder extends Seeder
{
    use CommonTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TmTender::truncate();
       
        for ($i = 0; $i < 30; $i++) {
            $start = new Carbon('first day of last month');
            $end = new Carbon('last day of last month');
            $maxId=TmTender::max("id");

            $tenderId=$this->common_generate_next_tender_no($maxId);

            $tender=["id"=>$tenderId,"title"=>"Sample Tender".$i,"description"=>"This is sample description","start_date"=>$start->format('Y-m-d'),"end_date"=>$start->format('Y-m-d'),"tm_tender_status_id"=>config("global.tender_active"),"crby"=>0,"location"=>"Test Location","tm_tender_category_id"=>rand(1,8)];
            
            TmTender::updateOrCreate([
                'id' => $tender["id"]
            ],$tender);
        }
    }
}
