<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withTimestamps()->withPivot(['quantity']);
    }
}
