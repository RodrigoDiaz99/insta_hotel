<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarifa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $table = "tarifas";

    public function room()
    {
        return $this->belongsTo(Room::class,'rooms_id');
    }
    public function room_type()
    {
        return $this->belongsTo(Room_type::class,'room_types_id');
    }
    public function tramo()
    {
        return $this->belongsTo(Tramo::class,'tramos_id');
    }
    public function establishment()
    {
        return $this->belongsToMany(Establishment::class,'id');
    }
}
