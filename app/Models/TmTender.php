<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmTender extends Model
{
    use HasFactory;
    protected $table = 'tm_tender';
    protected $fillable = ['id','title','description','start_date','end_date','tm_tender_status','crby','deposit','estimate_cost','location','tm_tender_category_id'];

    public function category()
    {
        return $this->belongsTo(TmTenderCategory::class,'tm_tender_category_id','id');
    }

}
