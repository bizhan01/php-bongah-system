<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequisition extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'branch_id',
        'employee_id',
        'purpose',
        'requisition_date',
        'required_date',
        'comment',
        'contract_person',
        'remark',

        'item',
        'requisition_id',
        'amount',
        

        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }


    public static function createRequisitionId($id)
    {
        $rqn= 'RQN-'.date("y");
        $id_no=str_pad($id, 4, '0', STR_PAD_LEFT);

        return $rqn.'-'.$id_no;

    }


}
