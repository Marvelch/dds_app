<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oppenent extends Model
{
    use HasFactory;

    protected $table = 'oppenents';

    protected $guarded = [
        'id'
    ];
}
