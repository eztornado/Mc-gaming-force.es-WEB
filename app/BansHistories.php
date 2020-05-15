<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BansHistories extends Model
{
    //
    protected $table = 'DKBans_histories';
    
    protected $fillable = [
        'uuid',
        'ip',
        'reason',
        'message',
        'staff',
        'type'
    ];
}
