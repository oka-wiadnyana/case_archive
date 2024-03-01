<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FileLoan extends Model
{
    use HasFactory;
    public $guarded=[];

    public function fileReturn():HasOne{
        return $this->hasOne(FileReturn::class,'loan_id');
    }
    public function loaner():HasOne{
        return $this->hasOne(Loaner::class,'id','loaner_id');
    }
    public function perkara():HasOne{
        return $this->hasOne(Perkara::class,'perkara_id','case_id');
    }
}
