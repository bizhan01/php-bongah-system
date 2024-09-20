<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sell extends Model
{

    use SoftDeletes;
    protected $fillable = [

        'customer_id',
        'branch_id',
        'product_id',
        'employee_id',
        'sells_date',


        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function ScheduleReceivable()
    {
        return $this->hasMany(ScheduleReceivable::class, 'sells_id', 'id');
    }

    public function ActualReceived()
    {
        return $this->hasMany(ActualReceived::class, 'sells_id', 'id');
    }
}
