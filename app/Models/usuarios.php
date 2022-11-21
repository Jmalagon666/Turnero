<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    //use HasFactory;
    protected $table="usuarios";
    protected $primaryKey="id";
    protected $fillable=["id","usuario","password","nombre","apellido","rol","taquilla"];

}
