<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class informacion extends Model
{
    //use HasFactory;
    protected $table="informacion";
    protected $primaryKey="id";
    protected $fillable=["id","nombre","taquilla","turno","tipo_turno","hora_inicio","hora_final","fecha","tiempo"];
    public $timestamps = false;
}
