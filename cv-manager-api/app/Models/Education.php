<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';

    protected $fillable = [
        'users_data_id',
        'school_name',
        'faculty',
        'course',
        'degree',
        'status',
        'from',
        'to'
    ];
}