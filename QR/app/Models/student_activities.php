<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentActivities extends Model
{
    protected $fillable = ['id', 'studentId', 'activityId'];
}