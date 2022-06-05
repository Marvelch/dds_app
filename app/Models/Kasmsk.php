<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kasmsk extends Model
{
    use HasFactory;

    protected $table = 'kasmsks';

    protected $guarded = [
        'created_at',
    ];
}
