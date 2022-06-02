<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryEditCekMasuk extends Model
{
    use HasFactory;

    protected $table = 'temporary_edit_cek_masuks';

    protected $guarded = [
        'id'
    ];
}
