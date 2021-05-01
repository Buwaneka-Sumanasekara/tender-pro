<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TmTender extends Model
{
    use HasFactory;
    protected $table = 'tm_tender';
    protected $fillable = ['id','title','description','start_date','end_date','tm_tender_status','crby','deposit','estimate_cost','location','tm_tender_category_id'];
    public $incrementing = false;
    
    public function category()
    {
        return $this->belongsTo(TmTenderCategory::class,'tm_tender_category_id','id');
    }

    public function isExpired(){
        return ($this->end_date < Carbon::now());
    }
    public function daysRemain(){
        $days=Carbon::now()->diffInDays($this->end_date, false);
        if($days===0){
            return "Closing Today";
        }else if($days>0){       
                return $days." Day".($days===1?"":"s")." to go";
        }else{
            return "Closed";
        }
    }

}
