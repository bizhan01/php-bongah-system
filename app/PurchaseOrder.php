<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'branch_id',
        'requisition_id',
        'purchase_id',
        'vendor_id',
        'media_name',
        'issuing_date',
        'date_of_delevery',
        'contract_person_1',
        'contract_person_2',
        'note',
        'subject',
        'message_body',
        'item',
        'totalAmount'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public static function getPurchaseId($id)
    {
        $rqn= 'PON-'.date("y");
        $id_no=str_pad($id, 4, '0', STR_PAD_LEFT);
        return $rqn.'-'.$id_no;
    }


}
