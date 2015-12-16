<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['total_price', 'commanded_at', 'status', 'customer_id'];

    // RELATION Products <-> Category  :
    public function products()
    {
        return $this->belongsToMany('App\Post');
    }

}
