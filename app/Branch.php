<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class Branch extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'location',
        
        'facing',
        'building_height',
        'land_area',
        'launching_date',
        'hand_over_date',


        'description',

        'create_by',
        'update_by',
        'delete_by'
    ];

    public function Transaction()
    {
        return $this->hasMany('App\Transaction','branch_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function purchaseRequisition()
    {
        return $this->hasMany(PurchaseRequisition::class,'branch_id','id');
    }

    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class,'branch_id','id');
    }

    


}
