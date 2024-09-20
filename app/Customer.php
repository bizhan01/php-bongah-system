<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Customer extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'father_or_husband_name',
        'phone',
        'email',
        'mailing_address',
        'nid',


        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function sells()
    {
        return $this->hasMany(Sell::class,'customer_id','id');
    }


}
