<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTemplate extends Model
{
    protected $fillable = ['name'];

    public function checklist()
    {
        return $this->belongsTo(ChecklistTemplate::class);
    }
}
