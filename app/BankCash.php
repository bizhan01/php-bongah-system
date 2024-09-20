<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class BankCash extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'account_number',
        'description',

        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function Transactions()
    {
        return $this->hasMany('App\Transaction','bank_cash_id');
    }

}
