<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;
    protected $table = 'reservaciones';

    public function establishment_id()
    {
        return $this->belongsTo(Establishment::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
