<?php

namespace App\Models;

use Filament\Tables\Filters\QueryBuilder\Constraints\RelationshipConstraint\Operators\HasMaxOperator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Archive extends Model
{
    use HasFactory;
    protected $connection="sipp";
    public $table="arsip";

    public function klasifikasi(): BelongsTo{
        return $this->belongsTo(Perkara::class,'perkara_id','perkara_id');
    }
  
   
    public function jenisPerkara(): HasOneThrough{
        return $this->hasOneThrough(AlurPerkara::class,Perkara::class,'perkara_id','id','perkara_id','alur_perkara_id');
    }


}
