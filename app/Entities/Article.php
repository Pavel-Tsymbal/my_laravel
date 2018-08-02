<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";
    protected $primaryKey = "id";

    protected $fillable = [
        'title',
        'short_text',
        'full_text',
        'author',
        'author_email'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class,'category_articles','article_id','category_id');
    }
}
