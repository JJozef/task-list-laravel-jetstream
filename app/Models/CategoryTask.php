<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'tasks_id',
        // other fillable fields
    ];
    public function tasks()
    {
        return $this->belongsToMany(Tasks::class, 'category_tasks');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}