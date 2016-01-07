<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'abstract', 'content', 'price', 'status', 'published_at', 'image_id', 'category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * RELATION Products <-> Category  :
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * RELATION Products <-> Tag  :
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * RELATION Products <-> image :
     */
    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * RELATION Products <-> Customer : // belongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany('App\Customer');
    }

    /**
     * @return $this
     *
     * RELATION Products <-> Order : // belongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }

    /**
     * @param $value
     *
     * // METHODE POUR FORMATER LA DATE AU MOMENT DE L'ENVOI DU FORMULAIRE (AJOUTER POST) :
     */
    public function setPublishedAtAttribute($value)
    {
        $now = Carbon::now();
        $this->attributes['published_at'] = "$value {$now->hour}:{$now->minute}:{$now->second}";
    }

    /**
     * @param $value
     * @return bool
     *
     * METHODE POUR COCHER LES CHECKBOXS AYANT DES TAGS :
     */
    public function hasTags($value)
    {
        foreach ($this->tags as $tag) {
            if ($tag->id == $value) return true;
        }

        return false;
    }

}
