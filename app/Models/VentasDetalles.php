<?php

namespace App\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasDetalles extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
