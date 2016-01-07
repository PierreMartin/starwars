<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'uri', 'uri_preview', 'uri_mini', 'status', 'published_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * RELATION Products <-> Image :
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }

}
