<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmTenderCategory extends Model
{
    use HasFactory;
    protected $table = 'tm_tender_category';
    protected $fillable = ['id','name','symble','active','icon'];

 
    /**
     * Get all of the Tenders for the category.
     */
   
    public function tenders()
    {
        return $this->hasMany(TmTender::class,'tm_tender_category_id','id');
    }

}
