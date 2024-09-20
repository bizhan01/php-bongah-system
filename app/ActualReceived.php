<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActualReceived extends Model
{

    protected $fillable = [
        'sells_id',
        'term',
        'received_amount',
        'adjustment',
        'actual_amount',
        'date_of_collection',
        'made_of_payment',
        'cheque_no',
        'bank_name',
        'remark',
    ];


    public function sell()
    {
        return $this->belongsTo(Sell::class, 'product_id', 'id');
    }
}
