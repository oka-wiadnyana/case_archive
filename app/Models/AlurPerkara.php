<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class AlurPerkara extends Model
{
    use HasFactory;
    protected $connection="sipp";
    public $table="alur_perkara";

   
}
