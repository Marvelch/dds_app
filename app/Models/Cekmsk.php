<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cekmsk extends Model
{
    use HasFactory;

    protected $table = 'Cekmsks';

    protected $guarded = [
        'id',
    ];
}
