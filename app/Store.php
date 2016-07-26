<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','address','city_id','order_no'];
    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
