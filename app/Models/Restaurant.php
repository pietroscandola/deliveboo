<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'image',
        'email',
        'phone',
        'address',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
