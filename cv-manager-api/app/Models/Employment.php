<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $table = 'employment';

    protected $fillable = [
        'users_data_id',
        'company',
        'role',
        'type',
        'experience',
        'achievements',
        'additional_skills',
        'from',
        'to'
    ];
}
