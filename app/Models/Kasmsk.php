<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasmsk extends Model
{
    use HasFactory;

    protected $table = 'kasmsk';

    protected $guarded = [
        'id',
    ];
}
