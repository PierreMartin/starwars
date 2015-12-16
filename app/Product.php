<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'abstract', 'content', 'price', 'status', 'published_at', 'image_id', 'category_id'];


    // RELATION Products <-> Category  :
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // RELATION Products <-> Tag  :
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    // RELATION Products <-> image :
    public function image() {
        return $this->hasMany('App\Image');
    }

    // RELATION Products <-> Customer : // belongsToMany
    public function customers() {
        return $this->belongsToMany('App\Tag');
    }

    // RELATION Products <-> Order : // belongsToMany
    public function orders() {
        return $this->belongsToMany('App\Tag');
    }

}
