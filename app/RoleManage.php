<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class RoleManage extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'content',
        'create_by',
        'update_by',
        'delete_by'
    ];

    public function users()
    {
       return $this->hasMany(User::class,'role_manage_id');
    }


}
