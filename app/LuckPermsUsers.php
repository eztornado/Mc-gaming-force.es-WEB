<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuckPermsUsers extends Model
{
    //
    protected $table = 'luckperms_players';
    protected $fillable = [
        'uuid',
        'username',
        'primary_group'
    ];
}
