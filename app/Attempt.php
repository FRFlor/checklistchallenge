<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = ['name'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
