<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'position',
        'department',
        'address',


        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function sells()
    {
        return $this->hasMany(Sell::class,'employee_id','id');
    }

    public function purchaseRequisition()
    {
        return $this->hasMany(PurchaseRequisition::class,'employee_id','id');
    }

}
