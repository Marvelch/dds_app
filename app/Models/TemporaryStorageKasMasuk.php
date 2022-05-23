<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;

class TemporaryStorageKasMasuk extends Model
{
    use HasFactory;

    protected $table = 'temporary_storage_kas_masuks';

    protected $guarded = [
        'id'
    ];

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'id_kasmsk');
    }
}
