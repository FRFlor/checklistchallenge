<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = ['name'];

    public function getCompletedAttribute()
    {
        return $this->tasks->reject(function ($task) {
            return $task->completed;
        })->isEmpty();
    }

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
        return Carbon::make($value)->format("M d, Y");
    }
}
