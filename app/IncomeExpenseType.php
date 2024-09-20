<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class IncomeExpenseType extends Model
{

    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'code',

        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function IncomeExpenseHeads()
    {
        return $this->hasMany('App\IncomeExpenseHead','income_expense_type_id');
    }


}
