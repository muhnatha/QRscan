<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    protected $table = 'activities';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id','activityName','qrCode','createdBy'];
};
