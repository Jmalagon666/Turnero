<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turno extends Model
{
    //use HasFactory;
    protected $table="turnos";
    protected $primaryKey="id";
    protected $fillable=["id","cod","turno","documento","modulo","created_at","update_at"];

}
