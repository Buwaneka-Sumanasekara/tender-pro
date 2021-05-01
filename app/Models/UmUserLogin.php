<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmUserLogin extends Model
{
         /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'um_user_login';
    protected $fillable = ['id','username','password','um_user_id'];
    public $incrementing = false;
}
