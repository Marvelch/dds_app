<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryStorageCekMasuk extends Model
{
    use HasFactory;

    protected $table = 'temporary_storage_cek_masuks';

    protected $guarded = [
        'id'
    ];
}
