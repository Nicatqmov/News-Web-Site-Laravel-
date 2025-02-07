<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $fillable=[
        'title',
        'description',
        'image',
    ];

    public function category(){
        return $this->hasMany(News::class);
    }
}
