<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudenActivities extends Model
{
    protected $fillable = ['id', 'studentId', 'activityId'];
}