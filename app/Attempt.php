<?php

namespace App;

use Carbon\Carbon;
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

    public function getCreatedAtAttribute($value)
    {
        return Carbon::make($value)->diffForHumans();
    }
}
