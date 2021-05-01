<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VmVendor extends Model
{
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vm_vendor';
    protected $fillable = ['id','company_name','address','contact_email','contact_mobile','contact_office','um_user_id'];
    public $incrementing = false;
}
