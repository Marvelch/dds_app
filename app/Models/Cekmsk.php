<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cekmsk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Cekmsks';

    protected $guarded = [
        'id',
    ];
}
