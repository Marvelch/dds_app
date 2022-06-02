<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kasmsk1 extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'kasmsk1s';

    protected $guarded = [
        'id',
    ];
}
