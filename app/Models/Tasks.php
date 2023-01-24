<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function estadotarea()
    {
        return $this->belongsTo(Estado::class, 'state_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_tasks');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'task_id');
    }
}