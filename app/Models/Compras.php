<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detalles()
    {
        return $this->hasMany(ComprasDetalles::class);
    }
}
