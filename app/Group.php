<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $table = 'luckperms_groups';
    protected $fillable = [
        'name'
    ];
}
