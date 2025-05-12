<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_Activities extends Model
{
    protected $fillable = ['id', 'studentId', 'activityId'];
}