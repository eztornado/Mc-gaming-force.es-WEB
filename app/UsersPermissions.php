<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPermissions extends Model
{
    //
    protected $table = 'luckperms_user_permissions';
    protected $fillable = [
        'uuid',
        'permission',
        'value',
        'server',
        'world',
        'expiry',
        'contexts'
    ];
}
