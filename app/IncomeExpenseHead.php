<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class IncomeExpenseHead extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'unit',
        'income_expense_type_id',
        'income_expense_group_id',
        'type',

        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function IncomeExpenseType()
    {
        return $this->belongsTo('App\IncomeExpenseType','income_expense_type_id');
    }

    public function IncomeExpenseGroup()
    {
        return $this->belongsTo('App\IncomeExpenseGroup','income_expense_group_id');
    }


    public function Transaction()
    {
        return $this->hasMany('App\Transaction','income_expense_head_id');
    }


}
