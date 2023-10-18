<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_group_id', 'type', 'name', 'label', 'placeholder', 'options', 'is_required'
    ];


    public function getFieldNameAttribute()
    {
        return strtolower($this->group()->first()->title)."_".$this->name;
    }

    public function group() : BelongsTo {
        return $this->belongsTo(FieldGroup::class, 'field_group_id');
    }
}
