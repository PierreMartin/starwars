<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email'];

    // RELATION Posts <-> Category  :
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

}
