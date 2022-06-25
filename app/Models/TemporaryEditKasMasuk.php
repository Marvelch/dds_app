<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryEditKasMasuk extends Model
{
    use HasFactory;

    protected $table = 'temporary_edit_kas_masuks';

    protected $guarded = [
        'id'
    ];

    public function oppenent()
    {
        return $this->belongsTo(oppenent::class, 'id_opponent');
    }
}
