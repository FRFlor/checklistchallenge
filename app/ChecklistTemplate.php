<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistTemplate extends Model
{
    protected $fillable = ['name'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
