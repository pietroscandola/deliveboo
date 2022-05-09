<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['restaurant_id', 'customer_name', 'customer_surname', 'customer_email', 'customer_address', 'customer_phone', 'amount', 'is_delivered', 'is_paid'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withTimestamps()->withPivot(['quantity']);
    }
}
