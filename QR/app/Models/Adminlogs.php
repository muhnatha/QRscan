<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adminlogs extends Model
{
    protected $filable = ['id', 'adminId', 'action'];
}
