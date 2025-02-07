<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable=[
        'is_active',
        'category_id',
        'title',
        'description',
        'image',
        'date',
        'views',
    ];

    public function category(){
        return $this->belongsTo(NewsCategory::class);
    }
}
