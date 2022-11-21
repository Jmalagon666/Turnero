<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    //use HasFactory;
    protected $table="area";
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable=["id","GCC","GCME","GCN","GCOE","GRC","GEC","PCME","PCN","PCOE","PRC","PEC","PCC"];
    public $timestamps = false;


}
