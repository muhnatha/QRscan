<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    protected $fillable = ['name', 'nisn', 'classId', 'id'];
}
