<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = [
        'teachers_id',
        'type',
        'snapshot',
        'user_id',
    ];
    use HasFactory;
}
