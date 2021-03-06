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
    protected $fillable = ['username', 'email', 'number_card'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * RELATION Products <-> Customer  :
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

}
