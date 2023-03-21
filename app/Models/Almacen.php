<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $table = 'almacen';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
