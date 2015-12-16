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
    protected $fillable = ['name', 'uri', 'status', 'published_at'];

    // RELATION Products <-> Image :
    public function products()
    {
        return $this->hasMany('App\Post');
    }

}
